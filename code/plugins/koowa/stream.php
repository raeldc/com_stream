<?php
/**
* @version		$Id: stream.php 29 2010-07-26 13:40:57Z copesc $
* @category		Koowa
* @package      Koowa_Plugins
* @copyright    Copyright (C) 2007 - 2010 Johan Janssens and Mathias Verraes. All rights reserved.
* @license      GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
* @link         http://www.koowa.org
*/

class PlgKoowaStream extends PlgKoowaDefault
{	
	public function onControllerAfterBrowse(KCommandcontext $context)
	{
		$this->processContext($context);
	}
	
	public function onControllerAfterRead(KCommandContext $context)
	{
		$this->processContext($context);
	}

	public function onControllerAfterEdit(KCommandContext $context)
    {
		$this->processContext($context);
    }	
    
    public function onControllerAfterAdd(KCommandContext $context)
    {
		$this->processContext($context);
    }	
    
    public function onControllerAfterDelete(KCommandContext $context)
    {
		$this->processContext($context);
    }	
    
    private function processContext(KCommandContext $context)
    {
	    $action = $context->action;
	    $caller = $context->caller;
	    $result = $context->result;
	    
	    $id = 0;

	    if ($action == 'delete')
	    {
			$id = $caller->id;
	    }
	    elseif ($action == 'add')
	    {
			if ($result instanceof KDatabaseRowDefault)
			{
		   
				$data = $result->getData();
				$id = $data['id'];
			}
		}
		elseif ($action == 'edit')
		{
			if (is_array(@$result->id))
			{
				$id = reset(@$result->id);
			}
		}

	   	$found = KFactory::tmp('admin::com.stream.model.controllers')
			->set('controller', get_class($caller))
			->set($action, 1)
			->getList();
	
	   	if (count($found)) 
	   	{
         	$string = substr(get_class($caller), 3);
            $option = strtolower(substr($string, 0, stripos($string, 'controller')));
            $view = strtolower(substr($string, stripos($string, 'controller')+10));
            $model = KInflector::pluralize($view);
            $title = KFactory::get('com.'.$option.'.model.'.$model)->id($id)->getItem()->title;
	
			if (!$title)
	   		{
	   			//don't have title if delete, search for title in this table
				$items = KFactory::tmp('site::com.stream.model.activities')
	   				->set('target_id', $id)
	   				->set('controller', get_class($caller))
	   				->getList()->getData();
	   				
	   			$item = reset($items);
	   			$title = $item['target_title'];
	   		}

	   		if (get_class($caller) == 'ComIssuesControllerIssue')
	   		{
		   		$parent_target_id = KFactory::tmp('site::com.issues.model.issues')->id($id)->getItem()->project_id;
			}
			elseif (get_class($caller) == 'ComProjectsControllerProject')
	   		{
		   		$parent_target_id = $id;
			}
			
			if (!$parent_target_id)
			{
				$items = KFactory::tmp('site::com.stream.model.activities')
	   				->set('target_id', $id)
	   				->set('controller', get_class($caller))
	   				->getList()->getData();
	   				
	   			$item = reset($items);
	   			$parent_target_id = $item['parent_target_id'];
			}
			
			$controllers = KFactory::tmp('admin::com.stream.model.controllers')->set('controller', get_class($caller))->getList()->getData();
			$controller = reset($controllers);		
		
			KFactory::tmp('site::com.stream.model.activities')
				->getItem()
				->set('stream_controller_id', $controller['id'])
				->set('action', $action)				
				->set('target_id', $id)				
				->set('target_title', $title)
				->set('parent_target_id', $parent_target_id)
				->save();
	   	}
	}
}