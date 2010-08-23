<?php
/**
 * com_jal      Developed using Nooku Framework 0.7 (see README.php for revision number)
 * @package		JAL
 * @copyright   Copyright (C) 2010 JooCode di Flavio Copes. All rights reserved.
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPLv2
 */

class ComStreamModelActivities extends KModelTable
{	
    public function __construct(KConfig $config) 
	{
		$config['table_behaviors'] = array('creatable'); 
		parent::__construct($config);
		
		$this->getState()
		 	->insert('stream_controller_id'  , 'int')
		 	->insert('action'  , 'string')
		 	->insert('pagination'  , 'string')
		 	->insert('parent_target_id', 'int')
		 	->insert('userid', 'int');
	}
	
	/**
	 * Order the activities in reverse cronological order
	 */
	protected function _buildQueryWhere(KDatabaseQuery $query)
	{
		parent::_buildQueryWhere($query);
		
		$query->select('controllers.controller, targets.title AS stream_target');
		$query->join('LEFT', 'stream_controllers AS controllers', 'controllers.stream_controller_id = tbl.stream_controller_id');
		$query->join('LEFT', 'stream_targets AS targets', 'targets.stream_target_id = controllers.stream_target_id');
		$query->order('created_on', 'DESC');
		
		$state = $this->getState();
		
		if ($state->parent_target_id)
		{
			$query->where('tbl.parent_target_id', '=', $state->parent_target_id);
		}
		
		if ($state->userid)
		{
		
		}
	}
}