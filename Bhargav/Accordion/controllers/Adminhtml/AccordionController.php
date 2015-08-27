<?php
/**
* 
*/
class Bhargav_Accordion_Adminhtml_AccordionController extends Mage_Adminhtml_Controller_Action
{
	
	public function indexAction(){
		$accordionBlock = $this->getLayout()->createBlock('bhargav_accordion_adminhtml/accordion');
		$this->loadLayout()
		->_addContent($accordionBlock)
		->renderLayout();
	}


	public function editAction(){
		$accordion = Mage::getModel('bhargav_accordion/accordion');
		if($accordionId = $this->getRequest()->getParam('id',false)){
			$accordion->load($accordionId);
			if($accordion->getId()<1){
				$this->_getSession()->addError($this->__('This accordion no longer exists.'));
				return $this->_redirect('bhargav_accordion_admin/accordion/index');
			}

		}
		if($postData = $this->getRequest()->getPost('accordionData')){
			try {
				$accordion->addData($postData);
				$accordion->save();
				$this->_getSession()->addSuccess($this->__('The accordion is saved.'));
				return $this->_redirect('bhargav_accordion_admin/accordion/edit',array('id' => $accordion->getId()));

			} catch (Exception $e) {
				Mage::logException($e);
				$this->_getSession()->addError($e->getMessage());
			}
		}

		Mage::register('current_accordion', $accordion);

		$accordionEditBlock = $this->getLayout()->createBlock('bhargav_accordion_adminhtml/accordion_edit');

		$this->loadLayout()
		->_addConten($accordionEditBlock)
		->renderLayout();


	}

	public function deleteAction(){
		$accordion = Mage::getModel('bhargav_accordion/accordion');

		if($accordionId = $this->getRequest()->getParam('id', false)){
			$accordion->load($accordionId);
		}
		if($accordion->getId()<1){
			$this->_getSession()->addError($this->__('This accordion no longer exists.'));
			return $this->_redirect('bhargav_accordion_admin/accordion/index');
		}

		try {

			$accordion->delete();
			$this->_getSession()->addSuccess($this->__('The Accordion has been deleted.'));

		} catch (Exception $e) {
			Mage::logException($e);
			$this->_getSession()->addError($e->getMessage());
		}
		return $this->_redirect('bhargav_accordion_admin/accordion/index');

	}
	
	protected function _isAllowed(){

		$actionName = $this->getRequest()->getActionName();
		switch ($actionName) {
			case 'index':
			case 'edit':
			case 'delete':
                // intentionally no break
			default:
			$adminSession = Mage::getSingleton('admin/session');
			$isAllowed = $adminSession
			->isAllowed('bhargav_accordion/accordion');
			break;
		}

		return $isAllowed;
	}
}

