CREATE TABLE `wpmu_xoops` (
  `bosn` smallint(5) unsigned NOT NULL,
  `counter` smallint(5) unsigned NOT NULL default '0',
  `picked` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`bosn`)
) TYPE=MyISAM;

