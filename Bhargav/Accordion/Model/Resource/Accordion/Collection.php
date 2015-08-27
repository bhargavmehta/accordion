<?php
/**
* 
*/
class Bhargav_Accordion_Model_Resource_Accordion_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	
	protected function _construct(argument)
	{
		parent::_construct();
		# code...
		$this->_init('bhargav_accordion/accordion','bhargav_accordion/accordion');
	}
}