<?php
/**
 * com_blog      Developed using Nooku Framework 0.7 (see README.php for revision number)
 * @version     $Id: feed.php 40 2010-07-29 15:49:10Z copesc $
 * @package		blog
 * @copyright   Copyright (C) 2010 JooCode di Flavio Copes. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPLv2
 */

class ComStreamViewActivitiesFeed extends KViewTemplate
{
	public function display()
	{			
		$user = KFactory::tmp('lib.joomla.user', array(KRequest::get('get.userid', 'int')));
		
		if ($user->username == KRequest::get('get.username', 'string')) 
		{
			$targets = KFactory::tmp('site::com.stream.model.targets')->getList()->getData();
			$thing = reset($targets); 
			$string = substr($thing['title'], 3);
			$option = strtolower(substr($string, 0, stripos($string, 'controller')));
			$view = strtolower(substr($string, stripos($string, 'controller')+10));
			$model = KInflector::pluralize($view);
			$list = KFactory::tmp('site::com.'.$option.'.model.'.$model)->userid($user->id)->getList()->getData();
			$array = array();
			
			foreach ($list as $item)
			{
				$array[] = $item['id'];
			}
						
			//Get the list of posts
			$activities = KFactory::get($this->getModel())->set('parent_target_id', KRequest::get('get.parent_target_id', 'int'))->getList();
			
			$doc =& JFactory::getDocument();
			
			foreach ( $activities as $activity )
			{
				if (!in_array($activity->parent_target_id, $array))
				{
					continue;
				}

				$date = new KDate();
				$date->setDate($activity->created_on);
				$currentDay == $date->format('%d %B');
							
				$user = KFactory::tmp('lib.joomla.user', array('id' => $activity->created_by));
	
				$string = substr($activity->controller, 3);
				$option = strtolower(substr($string, 0, stripos($string, 'controller')));
				$view = strtolower(substr($string, stripos($string, 'controller')+10));
				
				$link = '';
				if ($activity->action != 'delete') 
				{
					$link = KRequest::base().'/index.php?option=com_'.$option.'&view='.$view.'&id='.$activity->target_id.'&project_id='.$activity->parent_target_id.'&Itemid=2';
				}
	
				$description = '<i>'.JText::_($activity->controller.'-'.$activity->action).'</i>';
				$description .= ' '.$activity->target_title;
	
				//add the parent name in the description, if I'm not in a specialized view
				if (!KRequest::get('get.parent_target_id', 'int')) 
				{
					$targets = KFactory::tmp('site::com.stream.model.targets')->getList()->getData();
					$thing = reset($targets); 
					$string = substr($thing['title'], 3);
					$option = strtolower(substr($string, 0, stripos($string, 'controller')));
					$view = strtolower(substr($string, stripos($string, 'controller')+10));
					$model = KInflector::pluralize($view);
					$data =  KFactory::tmp('site::com.'.$option.'.model.'.$model)->id($activity->parent_target_id)->getItem();
					$description .= '<strong>'.$data->title.'</strong>';
				}
				
				$date = new KDate();
				$date->setDate($activity->created_on);
	
				$item = new JFeedItem();
				$item->title 		= $activity->target_title;
				$item->link 		= $link.'&param='.$activity->created_on;
				$item->description 	= $description;			
				$item->date = $date->format('%d %B %Y, %R');
				$item->category   	= '';
				$item->authorEmail = '';
				$item->author = '';

				$user = KFactory::tmp('lib.joomla.user', array('id' => $activity->created_by));
				
				if ($user->id)
				{
					$item->authorEmail = $user->email;
					$item->author = $user->name;
				}
				
				// loads item info into rss array			
				$doc->addItem( $item );
			}
			$doc->link = $this->createRoute('format=html&view=activities');
		}
	}
}