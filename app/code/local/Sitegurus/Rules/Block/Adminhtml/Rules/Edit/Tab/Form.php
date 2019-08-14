<?php
class Sitegurus_Rules_Block_Adminhtml_Rules_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('rules_form', array('legend'=>Mage::helper('rules')->__('Rules information')));
      
      //$categories = Mage::getModel('catalog/category')->getCollection()->addAttributeToSelect('*');
      
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('rules')->__('Title of Rule'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

   $cats=Mage::getModel('catalog/category')->load(2)->getChildren();
   $catIds=explode(',',$cats);
   foreach($catIds as $id)
   {
		$category=Mage::getModel('catalog/category')->load($id);
		$tmp1[]=array(
                  'value'     => $category->getId(),
                  'label'     => $category->getName(),
              );
		if($category->hasChildren())
		{
			$cats1=$category->getChildren();
			$catIds1=explode(',',$cats1);
			 foreach($catIds1 as $id1)
			{
				$category1=Mage::getModel('catalog/category')->load($id1);
				$tmp1[]=array(
                  'value'     => $category1->getId(),
                  'label'     => '-----'.$category1->getName(),
              );
		
				if($category1->hasChildren())
				{
					$cats2=$category1->getChildren();
					$catIds2=explode(',',$cats2);
					foreach($catIds2 as $id2)
					{
						$category2=Mage::getModel('catalog/category')->load($id2);
						$tmp1[]=array(
							'value'     => $category2->getId(),
						  'label'     => '-----------'.$category2->getName(),
					  );
				
					}
				}
			}
		}
   }
 
   foreach($categories as $v){
            $tmp[]=array(
                  'value'     => $v->getId(),
                  'label'     => $v->getName(),
              );
      }
 
            $categoryId=$this->getRequest()->getParam('categories');
  
	$fieldset->addField('category_name', 'select', array(
          'label'     => Mage::helper('rules')->__('Category Name'),
          'name'      => 'category_name',
          'values'    => $tmp1, 
          'value'      =>($categoryId)?$categoryId:'', 
          'required'  => true,
      ));
    	
      
      $fieldset->addField('shipping_method', 'select', array(
          'label'     => Mage::helper('rules')->__('Shipping Method'),
          'name'      => 'shipping_method',
          'required'  => true,
          'values'    => array(
              
              array(
                  'value'     => 0,
                  'label'     => Mage::helper('rules')->__(''),
              ),
              array(
                  'value'     => "Free Shipping",
                  'label'     => Mage::helper('rules')->__('Free Shipping'),
              ),

              array(
                  'value'     => "Paid Shipping",
                  'label'     => Mage::helper('rules')->__('Paid Shipping'),
              ),
          ),
      ));
      
      
      $fieldset->addField('payment_method', 'select', array(
          'label'     => Mage::helper('rules')->__('Payment Method'),
          'name'      => 'payment_method',
          'required'  => true,
          'values'    => array(
              array(
                  'value'     => 0,
                  'label'     => Mage::helper('rules')->__(''),
              ),
              array(
                  'value'     => "Only Pre Payment",
                  'label'     => Mage::helper('rules')->__('Only Pre Payment'),
              ),

              array(
                  'value'     => "Pre/Post Payment",
                  'label'     => Mage::helper('rules')->__('Pre/Post Payment'),
              ),
          ),
      ));
      
      
      $fieldset->addField('return_method', 'select', array(
          'label'     => Mage::helper('rules')->__('Return Method'),
          'name'      => 'return_method',
          'required'  => true,
          'values'    => array(
              array(
                  'value'     => 0,
                  'label'     => Mage::helper('rules')->__(''),
              ),
              array(
                  'value'     => "Not Available",
                  'label'     => Mage::helper('rules')->__('Not Available'),
              ),

              array(
                  'value'     => "Free Return",
                  'label'     => Mage::helper('rules')->__('Free Return'),
              ),
              array(
                  'value'     => "Paid Return",
                  'label'     => Mage::helper('rules')->__('Paid Return'),
              ),
              
          ),
      ));
        
        
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('rules')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 0,
                  'label'     => Mage::helper('rules')->__(''),
              ),
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('rules')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('rules')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('description', 'editor', array(
          'name'      => 'description',
          'label'     => Mage::helper('rules')->__('Description'),
          'title'     => Mage::helper('rules')->__('Description'),
          'style'     => 'width:700px; height:200px;',
          'wysiwyg'   => false,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getRulesData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getRulesData());
          Mage::getSingleton('adminhtml/session')->setRulesData(null);
      } elseif ( Mage::registry('rules_data') ) {
          $form->setValues(Mage::registry('rules_data')->getData());
      }
      return parent::_prepareForm();
  }
}