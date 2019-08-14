<?php

class Sitegurus_Rules_Model_Mysql4_Rules extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the rules_id refers to the key field in your database table.
        $this->_init('rules/rules', 'rules_id');
    }
}