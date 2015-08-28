<?php
class Bhargav_Accordion_Adminhtml_AccordionController 
extends Mage_Adminhtml_Controller_Action
{
	 /**
     * Instantiate our grid container block and add to the page content.
     * When accessing this admin index page we will see a grid of all
     * brands currently available in our Magento instance, along with
     * a button to add a new one if we wish.
     */
	 public function indexAction(){
		// instantiate the grid container
	 	$accordionBlock = $this->getLayout()->createBlock('bhargav_accordion_adminhtml/accordion');

		// add the grid container as the only item on this page
	 	$this->loadLayout()
	 	->_addContent($accordionBlock)
	 	->renderLayout();
	 }

	 /**
     * This action handles both viewing and editing of existing brands.
     */

    public function editAction(){
 	 /**
     * retrieving existing brand data if an ID was specified,
     * if not we will have an empty Brand entity ready to be populated.
     */
   $accordion = Mage::getModel('bhargav_accordion/accordion');
   if ($accordionId = $this->getRequest()->getParam('id', false)) {
    $accordion->load($accordionId);

    if ($accordion->getId() < 1) {
        $this->_getSession()->addError(
            $this->__('This accordion no longer exists.')
            );
        return $this->_redirect(
            'bhargav_accordion_admin/accordion/index'
            );
    }
}
        // process $_POST data if the form was submitted
if($postData = $this->getRequest()->getPost('accordionData')){
 try {

    if( isset($postData['page']) ) {
        $postData['page_id'] = $postData['page'];
        if( in_array('0', $postData['page_id']) ){
            $postData['page'] = '0';
        } else {
            $postData['page'] = join(",", $postData['page_id']);
        }
        unset($postData['page_id']);
    }
    if( isset($postData['store_id']) ) {
        $postData['stores'] = $postData['store_id'];
        if( in_array('0', $postData['stores']) ){
            $postData['store_id'] = '0';
        } else {
            $postData['store_id'] = join(",", $postData['stores']);
        }
        unset($postData['stores']);
    }
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
->_addContent($accordionEditBlock)
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

