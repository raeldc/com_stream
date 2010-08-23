<?php
/**
 * @version		$Id: stream.php 22 2010-07-25 17:29:36Z copesc $
 * @package		error
 * @copyright	Copyright (C) 2009 - 2010 Nooku. All rights reserved.
 * @license 	GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.nooku.org
 */

// Check if Koowa is active
if(!defined('KOOWA')) {
    JError::raiseWarning(0, JText::_("Koowa wasn't found. Please install the Koowa plugin and enable it."));
    return;
}

// Require the defines
KLoader::load('admin::com.stream.defines');
KFactory::map('lib.koowa.template.helper.behavior', 'admin::com.stream.helper.behavior'); 
 
// Create the controller dispatcher
KFactory::get('admin::com.stream.dispatcher')->dispatch(KRequest::get('get.view', 'cmd', 'targets'));
