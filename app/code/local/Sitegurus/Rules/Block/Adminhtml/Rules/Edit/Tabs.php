<?php

class Sitegurus_Rules_Block_Adminhtml_Rules_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('rules_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('rules')->__('Rule Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('rules')->__('Rule Information'),
          'title'     => Mage::helper('rules')->__('Rule Information'),
          'content'   => $this->getLayout()->createBlock('rules/adminhtml_rules_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}