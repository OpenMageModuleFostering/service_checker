<?php
class Sitegurus_Rules_Block_Adminhtml_Rules extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_rules';
    $this->_blockGroup = 'rules';
    $this->_headerText = Mage::helper('rules')->__('Rule Manager');
    $this->_addButtonLabel = Mage::helper('rules')->__('Add Rule');
    parent::__construct();
  }
}