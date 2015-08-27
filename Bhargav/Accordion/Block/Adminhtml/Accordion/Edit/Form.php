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
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'general',
            array(
                'legend' => $this->__('Accordion Details')
            )
        );
        $accordionSingleton = Mage::Singleton('bhargav_accordion/accordion');

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
            'page' => array(
                'label' => $this->__('Page'),
                'input' => 'number',
                'required' => true,
            ),

        	));
         return $this;
	}
	protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)){
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