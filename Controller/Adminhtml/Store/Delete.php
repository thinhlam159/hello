<?php


namespace Mageplaza\HelloWorld\Controller\Adminhtml\Store;

/**
 * Class Delete
 *
 * @package Mageplaza\HelloWorld\Controller\Adminhtml\Store
 */
class Delete extends \Mageplaza\HelloWorld\Controller\Adminhtml\Store
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('store_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Mageplaza\HelloWorld\Model\Store::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Store.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['store_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Store to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

