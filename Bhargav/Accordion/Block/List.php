<?php
/**
* 
*/
class Bhargav_Accordion_Block_List extends Mage_Core_Block_Template
{
	 public function getAccordionCollection()
    {
        return Mage::getModel('bhargav_accordion/accordion')->getCollection()
            ->addFieldToFilter('visibility', Bhargav_Accordion_Model_Accordion::VISIBILITY_DIRECTORY)
            ->setOrder('title', 'ASC');

    }
}