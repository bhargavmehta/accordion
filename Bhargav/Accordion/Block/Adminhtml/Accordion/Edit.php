<?php
/**
* 
*/
class Bhargav_Accordion_Block_Adminhtml_Accordion_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	
	protected function _construct()
	{
		# code...
		$this->_blockGroup = 'bhargav_accordion_adminhtml';
		$this->_controller = 'accordion';

		$this->_mode = 'edit';
		$newOrEdit = $this->getRequest()->getParam('id') ? $this->__('Edit') : $this->__('New');
		$this->_headerText =  $newOrEdit . ' ' . $this->__('Accordion');
	}
}