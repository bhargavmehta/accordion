<?php 

/**
* 
*/
class Bhargav_Accordion_Block_Adminhtml_Accordion_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
	protected function _prepareForm()
	{
		# code...
		$form = new Varien_Data_Form(array(
			'id' => 'edit_form',
			'action' => $this->getUrl('bhargav_accordion_admin/accordion/edit',
				array(
					'_current' => true,
                    'continue' => 0,
                    )
				),
			'method' => 'post',
			));
		$form->setUseContainer(true);
        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Accordion Details')
                )
            );
        $accordionSingleton = Mage::getSingleton('bhargav_accordion/accordion');

        $this->_addFieldsToFieldset($fieldset,array(
          'title' => array(
            'label' => $this->__('Title'),
            'input' => 'text',
            'required' => true,
            ),
          'text' => array(
            'label' => $this->__('Text'),
            'input' => 'textarea',
            'required' => true,
            ),
          'visibility' => array(
            'label' => $this->__('Visibility'),
            'input' => 'select',
            'required' => true,
            'options' => $accordionSingleton->getAvailableVisibilies(),
            ),
          'page'=>array(
            'label' => $this->__('Page'),
            'input' => 'multiselect',
            'required' => true,
            'values' => array(
              '1' => array(
                'value'=> '1',
                'label' => 'Home Page'   
                ),
              '2' => array(
               'value'=> '2',
               'label' => 'About Us'  
               ),
              '3' => array(
               'value'=> '3',
               'label' => 'Help'  
               ),                                         

              ),

            ),

          ));
if (!Mage::app()->isSingleStoreMode()) {
   $this->_addFieldsToFieldset($fieldset,array(
    'store_id'=>array(
        'label' => $this->__('Store View'),
        'name' => 'stores[]',
        'required' => true,
        'input' =>'multiselect',
        'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(),
        ),
    ));
}else {
    $this->_addFieldsToFieldset($fieldset,array(
        'store_id'=>array(
            'name' => 'stores[]',
            'values' => Mage::app()->getStore(true)->getId(),
            ),
        ));
}
$this->setForm($form);
return $this;
}
protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields){
  $requestData = new Varien_Object($this->getRequest()->getPost('accordionData'));
  foreach ($fields as $name => $_data) {
    if ($requestValue = $requestData->getData($name)) {
        $_data['value'] = $requestValue;
    }
			# code...
    $_data['name'] = "accordionData[$name]";
    $_data['title'] = $_data['label'];
    if (!array_key_exists('value', $_data)) {
        $_data['value'] = $this->_getAccordion()->getData($name);
    }
    $fieldset->addField($name, $_data['input'], $_data);

}

return $this;
}

protected function _getAccordion(){
  if(!$this->hasData('accordion')){
   $accordion = Mage::registry('current_accordion');
   if (!$accordion instanceof Bhargav_Accordion_Model_Accordion) {
    $accordion = Mage::getModel(
        'bhargav_accordion/accordion'
        );
}
$this->setData('accordion', $accordion);

}
return $this->getData('accordion');
}

}