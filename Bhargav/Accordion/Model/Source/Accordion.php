<?php
/**
* 
*/
class Bhargav_Accordion_Model_Source_Accordion extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
	
	public function getAllOptions()	{
		# code...
		$accordionCollection = Mage::getModel('bhargav_accordion/accordion')->getCollection();

        $options = array(
            array(
                'label' => '',
                'value' => '',
            ),
        );
        
        foreach ($accordionCollection as $_accordion) {
            $options[] = array(
                'label' => $_brand->getTitle(),
                'value' => $_brand->getId(),
            );
        }
        
        return $options;
	}
}