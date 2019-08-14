<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('rules')};
CREATE TABLE {$this->getTable('rules')} (
  `rules_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `category_name` varchar(255) NOT NULL default '',
  `shipping_method` varchar(255) NOT NULL default '', 
  `payment_method` varchar(255) NOT NULL default '', 
  `return_method` varchar(255) NOT NULL default '', 
  `description` text NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`rules_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 