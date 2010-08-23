<?php
/**
 * @version		$Id: mod_streamtargets.php 29 2010-07-26 13:40:57Z copesc $
 * @package		mod_submenuprojects
 * @copyright	Copyright (C) 2009 - 2010 Nooku. All rights reserved.
 * @license 	GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.nooku.org
 */

// Check if Koowa is active
if(!defined('KOOWA')) {
	JError::raiseWarning(0, JText::_("Koowa wasn't found. Please install the Koowa plugin and enable it."));
	return;
}

KFactory::get('site::mod.streamtargets.html', array(
	'params'  => $params,
	'module'  => $module,
	'attribs' => $attribs
))->display();