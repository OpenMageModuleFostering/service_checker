<?php
class Sitegurus_Rules_Block_Rules extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getRules()     
     { 
        if (!$this->hasData('rules')) {
            $this->setData('rules', Mage::registry('rules'));
        }
        return $this->getData('rules');
        
    }
}