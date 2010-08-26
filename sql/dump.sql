CREATE TABLE IF NOT EXISTS `jos_stream_activities` (
  `stream_activity_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stream_controller_id` int(11) NOT NULL,
  `action` char(6) NOT NULL,
  `target_id` int(11) NOT NULL,
  `target_title` varchar(255) NOT NULL,
  `parent_target_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`stream_activity_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `jos_stream_controllers` (
  `stream_controller_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stream_target_id` bigint(20) unsigned NOT NULL,
  `controller` varchar(255) NOT NULL,
  `browse` binary(1) NOT NULL DEFAULT '1',
  `read` binary(1) NOT NULL DEFAULT '1',
  `add` binary(1) NOT NULL DEFAULT '0',
  `edit` binary(1) NOT NULL DEFAULT '0',
  `delete` binary(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`stream_controller_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `jos_stream_targets` (
  `stream_target_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  PRIMARY KEY (`stream_target_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `jos_stream_targets` (`stream_target_id`, `title`) VALUES
(1, 'ComProjectsControllerProject');

INSERT INTO `jos_stream_controllers` (`stream_controller_id`, `stream_target_id`, `controller`, `browse`, `read`, `add`, `edit`, `delete`) VALUES
(1, 1, 'ComIssuesControllerIssue', '0', '0', '1', '1', '1'),
(3, 1, 'ComProjectsControllerProject', '0', '0', '1', '0', '1');
