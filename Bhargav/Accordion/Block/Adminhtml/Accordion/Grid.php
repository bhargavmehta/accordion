<?php
/**
* 
*/
class Bhargav_Accordion_Block_Adminhtml_Accordion_Grid 
    extends Mage_Adminhtml_Block_Widget_Grid
{
	
	protected function _prepareCollection()
	{
		# code...
		$collection = Mage::getResouceModel(
				'bhargav_accordion/accordion_collection'
			);
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}
	public function getRowUrl($row)
	{
		# code...
		return $this->getUrl('bhargav_accordion_admin/accordion/edit',array(
                'id' => $row->getId()
            ));
	}
	protected function _prepareColumns(){
		$this->addColumn('entity_id',array(
			'header' => $this->_getHelper()->__('ID'),
            'type' => 'number',
            'index' => 'entity_id',
			));
		 $this->addColumn('created_at', array(
            'header' => $this->_getHelper()->__('Created'),
            'type' => 'datetime',
            'index' => 'created_at',
        ));

        $this->addColumn('updated_at', array(
            'header' => $this->_getHelper()->__('Updated'),
            'type' => 'datetime',
            'index' => 'updated_at',
        ));
         $this->addColumn('title', array(
            'header' => $this->_getHelper()->__('Title'),
            'type' => 'text',
            'index' => 'title',
        ));
       	 $accordionSingleton = Mage::getSingleton(
            'bhargav_accordion/accordion'
        );
       	$this->addColumn('visibility', array(
            'header' => $this->_getHelper()->__('Visibility'),
            'type' => 'options',
            'index' => 'visibility',
            'options' => $accordionSingleton->getAvailableVisibilies()
        ));
        $this->addColumn('action',array(
        	'header' => $this->_getHelper()->__('Action'),
            'width' => '50px',
            'type' => 'action',
            'actions'=> array(
            		array(
            				'caption' => $this->_getHelper()->__('Edit'),
            				'url' => array(
            						'base' => 'bhargav_accordion_admin'.'accordion/edit',
            					),
            				'feild' => 'id'
            			),
            	),
    		'filter' => false,
    		'sortable' => false,
    		'index' => 'entity_id',
        	));

        return parent::_prepareColumns();
	}
	protected function _getHelper(){
		return Mage::helper('bhargav_accordion');
	}
}