<?php
/**
 * @version		$Id: select.php 22 2010-07-25 17:29:36Z copesc $
 * @package		error
 * @copyright	Copyright (C) 2009 - 2010 Nooku. All rights reserved.
 * @license 	GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.nooku.org
 */

class ComStreamHelperSelect extends ComDefaultHelperListbox
{	
	public function target($config = array())
 	{
 		$config = new KConfig($config);
		$config->append(array(
			'name'		=> 'stream_target_id',
			'state' 	=> null,
			'attribs'	=> array(),
		));
		
		$list = KFactory::tmp('admin::com.stream.model.targets')
			->getList();
 		
 		$options = array();
 		$options[] =  $this->option(array('value' => 0, 'text' => '- '. JText::_( 'Select target' ) .' -' ));
 		
 		foreach ($list as $item)
 		{
 		 	$options[] = $this->option( array('value' => $item->id, 'text' => $item->title));
 		}
 		 		
 		$list = $this->optionlist(array(
			'options' 	=> $options, 
			'name' 		=> $config->name, 
			'attribs' 	=> $config->attribs, 
			'selected' 	=> $config->selected,
		));
		
		return $list;
	}
	
	public function enable($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'state' 	=> null,
			'attribs'	=> array(),
		));
		
			
		$options = array();
		$options[] =  $this->option(array('value' => 0, 'text' => 'Off' ));			 
		$options[] = $this->option( array('value' => 1, 'text' => 'On'));
			 		
		$list = $this->optionlist(array(
			'options' 	=> $options, 
			'name' 		=> $config->name, 
			'attribs' 	=> $config->attribs, 
			'selected' 	=> $config->selected,
		));
		
		return $list;
	}
}