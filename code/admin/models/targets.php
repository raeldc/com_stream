<?php
/**
 * com_help   	Developed using Nooku Framework 0.7  
 * @version     $Id: targets.php 22 2010-07-25 17:29:36Z copesc $
 * @package		com_help
 * @copyright   Copyright (C) 2010 JooCode di Flavio Copes. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPLv2
 * @link 		http://www.joocode.com
 */

class ComStreamModelTargets extends KModelTable
{
    public function __construct(KConfig $config) 
	{		
		parent::__construct($config);
		
		$this->getState()
		 	->insert('target_type'  , 'string')
		 	->insert('parent_page'  , 'int')
		 	->insert('text'  , 'string');
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
		
		if ($state->parent_page) 
		{
			$query->where('parent_page', '=', $state->parent_page);
		}
		
		parent::_buildQueryWhere($query);
	}
	
}