<?php

class Sitegurus_Rules_Block_Adminhtml_Rules_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('rulesGrid');
      $this->setDefaultSort('rules_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('rules/rules')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('rules_id', array(
          'header'    => Mage::helper('rules')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'rules_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('rules')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));
      
      $this->addColumn('category_name', array(
          'header'    => Mage::helper('rules')->__('Category ID'),
          'align'     =>'left',
          'index'     => 'category_name',
      ));
      
      $this->addColumn('shipping_method', array(
          'header'    => Mage::helper('rules')->__('Shipping'),
          'align'     =>'left',
          'index'     => 'shipping_method',
      ));
      
      $this->addColumn('payment_method', array(
          'header'    => Mage::helper('rules')->__('Payment'),
          'align'     =>'left',
          'index'     => 'payment_method',
      ));
      
      $this->addColumn('return_method', array(
          'header'    => Mage::helper('rules')->__('Return'),
          'align'     =>'left',
          'index'     => 'return_method',
      ));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('rules')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */

      $this->addColumn('status', array(
          'header'    => Mage::helper('rules')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('rules')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('rules')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('rules')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('rules')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('rules_id');
        $this->getMassactionBlock()->setFormFieldName('rules');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('rules')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('rules')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('rules/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('rules')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('rules')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}