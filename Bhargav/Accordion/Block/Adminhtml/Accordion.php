<?php
/**
* 
*/
class Bhargav_Accordion_Block_Adminhtml_Accordion extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	
	protected function _construct()
	{
		# code...
		parent::_construct();
		$this->_blockGroup = 'bhargav_accordion_adminhtml';
		$this->_controller = 'accordion';
		$this->_headerText = Mage::helper('bhargav_accordion')->__('Accordions');
	}

	public function getCreateUrl(){
		return $this->getUrl('bhargav_accordion_admin/accordion/edit');
	}
}