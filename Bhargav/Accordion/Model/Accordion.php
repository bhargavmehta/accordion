<?php 
/**
* 
*/
class Bhargav_Accordion_Model_Accordion extends Mage_Core_Model_Abstract
{
	const VISIBILITY_HIDDEN = '0';
    const VISIBILITY_DIRECTORY = '1';
	public function _construct(argument)
	{
		# code...
		$this->_init('bhargav_accordion/accordion');

	}
	public function getAvailableVisibilies()
	{
		# code...
		 return array(
            self::VISIBILITY_HIDDEN
                => Mage::helper('bhargav_accordion')
                       ->__('Hidden'),
            self::VISIBILITY_DIRECTORY
                => Mage::helper('bhargav_accordion')
                       ->__('Visible in Directory'),
        );
	}
	protected function _beforeSave(){
		parent::_beforeSave();
		$this->_updateTimestamps();
		return $this;
	}
	protected function _updateTimestamps(){
		$timestamp = now();
		$this->setUpdatedAt($timestamp);
		if($this->isObjectNew()){
			 $this->setCreatedAt($timestamp);
		}
		return $this;
	}
}