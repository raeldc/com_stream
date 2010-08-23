<?php
/**
 * @version		$Id: html.php 29 2010-07-26 13:40:57Z copesc $
 * @package		com_help
 * @copyright	Copyright (C) 2009 - 2010 Nooku. All rights reserved.
 * @license 	GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.nooku.org
 */

class ComStreamViewHtml extends ComDefaultViewHtml
{
	public function __construct(KConfig $config)
	{
        $config->views = array(
			'targets' 		=> JText::_('Targets'),
			'controllers' 		=> JText::_('Controllers'),
		);
		
		parent::__construct($config);
	}
	
	public function display()
	{
		$name = $this->getName();
		
		//Append enable and disbale button for all the list views
		if($name != 'dashboard' && KInflector::isPlural($name) && KRequest::type() != 'AJAX')
		{
			KFactory::get('admin::com.error.toolbar.'.$name)
				->append('divider')	
				->append('enable')
				->append('disable');	
		}
					
		return parent::display();
	}
}