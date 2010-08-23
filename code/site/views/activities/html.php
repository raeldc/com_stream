<?php
/**
 * com_blog      Developed using Nooku Framework 0.7 (see README.php for revision number)
 * @version     $Id: html.php 44 2010-07-31 17:12:44Z copesc $
 * @package		blog
 * @copyright   Copyright (C) 2010 JooCode di Flavio Copes. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPLv2
 */

class ComStreamViewActivitiesHtml extends ComDefaultViewHtml
{
	public function display()
	{		
		$targets = KFactory::tmp('site::com.stream.model.targets')->getList()->getData();
		$thing = reset($targets); 
		$string = substr($thing['title'], 3);
		$option = strtolower(substr($string, 0, stripos($string, 'controller')));
		$view = strtolower(substr($string, stripos($string, 'controller')+10));
		$model = KInflector::pluralize($view);
		$list = KFactory::tmp('site::com.'.$option.'.model.'.$model)->getList()->getData();
		$array = array();
		
		foreach ($list as $item)
		{
			$array[] = $item['id'];
		}
					
		//Get the list of posts
		$activities = KFactory::get($this->getModel())->set('parent_target_id', KRequest::get('get.parent_target_id', 'int'))->getList();

		$myactivities = array();
		
    	foreach (@$activities as $activity) 
    	{
	        if (!in_array($activity->parent_target_id, $array))
    	    {
    	        continue;
    	    }
    	    else
    	    {
    	    	$myactivities[] = $activity;
    	    }
    	}
	
		$this->assign('myactivities', $myactivities);
	
		$this->assign('pagination', KFactory::get($this->getModel())->getState()->pagination);
		return parent::display();
	}
}