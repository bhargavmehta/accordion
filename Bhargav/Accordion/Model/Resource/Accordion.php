<?php
/**
* 
*/
class Bhargav_Accordion_Model_Resource_Accordion extends Mage_Core_Model_Resource_Db_Abstract
{
	
	protected function _construct()
	{
		# code...
		 $this->_init('bhargav_accordion/accordion', 'entity_id');
	}
}