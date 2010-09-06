Credits
========
	/**
	 * com_stream	Developed using Nooku Framework 0.7  
	 * @package		com_stream
	 * @copyright   Copyright (C) 2010 JooCode di Flavio Copes. All rights reserved.
	 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPLv2
	 */

Stream of activities for any Nooku component

INSTALLATION
------------

Simply download the package and symlink from the Joomla installation

####/administrator:####
	`ln -s com_stream_directory/admin com_stream`
####/components:####
	`ln -s com_stream_directory/site com_stream`
####/language/en-GB:####
	`ln -s com_stream_directory/language/en-GB-com_stream.ini en-GB-com_stream.ini`
####/media:####
	`ln -s com_stream_directory/media com_stream`
####/modules:####
	`ln -s com_stream_directory/modules/mod_streamtargets mod_streamtargets`
####/plugins/koowa:####
	`ln -s com_stream_directory/plugins/koowa/stream.php stream.php`

USAGE
-----

Add a com_stream entry to the jos_components table and create the DB tables found in sql/

From the administrator interface you can now add a target, such as ComProjectsControllerProject or any name you want.
For this target you can define which controllers you want to observe, in the example sql:

**ComIssuesControllerIssue**
**ComProjectsControllerProject**

Then check the actions you want to monitor. Only the standards BREAD actions are supported now.
When a certain action occurs on those controllers, it will be listed in the table `jos_stream_activities`, and accessible from the frontend interface using e.g. HMVC from any component. This way you can have a simple activity tracking tool for your app.

	<h2>Latest activity</h2>
	<? KFactory::get('lib.joomla.language.language')->load('com_stream'); ?>
	<?= KFactory::tmp('site::com.stream.controller.activity')->limit(10)->set('pagination', 'off')->parent_target_id($the_id)->browse(); ?>

Tested on Nooku Framework rev. 2513