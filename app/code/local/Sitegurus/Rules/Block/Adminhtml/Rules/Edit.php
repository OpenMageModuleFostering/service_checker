<?php

class Sitegurus_Rules_Block_Adminhtml_Rules_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'rules';
        $this->_controller = 'adminhtml_rules';
        
        $this->_updateButton('save', 'label', Mage::helper('rules')->__('Save Rule'));
        $this->_updateButton('delete', 'label', Mage::helper('rules')->__('Delete Rule'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('rules_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'rules_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'rules_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('rules_data') && Mage::registry('rules_data')->getId() ) {
            return Mage::helper('rules')->__("Edit Rule '%s'", $this->htmlEscape(Mage::registry('rules_data')->getTitle()));
        } else {
            return Mage::helper('rules')->__('Add Rule');
        }
    }
}