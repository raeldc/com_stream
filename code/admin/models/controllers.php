<?php
/**
 * com_help   	Developed using Nooku Framework 0.7  
 * @version     $Id: controllers.php 29 2010-07-26 13:40:57Z copesc $
 * @package		com_help
 * @copyright   Copyright (C) 2010 JooCode di Flavio Copes. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPLv2
 * @link 		http://www.joocode.com
 */

class ComStreamModelControllers extends KModelTable
{
    public function __construct(KConfig $config) 
	{		
		parent::__construct($config);
		
		$this->getState()
		 	->insert('controller'  , 'string')
		 	->insert('browse'  , 'boolean')
		 	->insert('read'  , 'boolean')
		 	->insert('edit'  , 'boolean')
		 	->insert('add'  , 'boolean')
		 	->insert('delete'  , 'boolean');
	}
	
	protected function _buildQueryWhere(KDatabaseQuery $query)
	{
		$state = $this->getState();
		
		if ($state->search) 
		{
			$search = '%'.$state->search.'%';
			$query->where('tbl.target_type', 'LIKE',  $search);
			$query->where('tbl.text', 'LIKE',  $search, 'OR');
		}
		if ($state->controller)
		{
			$query->where('tbl.controller', '=', $state->controller);
		}
		if ($state->browse)
		{
			$query->where('tbl.browse', '=', 1);
		}
		if ($state->read)
		{
			$query->where('tbl.read', '=', 1);
		}
		if ($state->edit)
		{
			$query->where('tbl.edit', '=', 1);
		}
		if ($state->add)
		{
			$query->where('tbl.add', '=', 1);
		}
		if ($state->delete)
		{
			$query->where('tbl.delete', '=', 1);
		}
		
		parent::_buildQueryWhere($query);
	}
	
}