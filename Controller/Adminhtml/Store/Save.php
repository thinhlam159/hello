<?php


namespace Mageplaza\HelloWorld\Controller\Adminhtml\Store;

use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 *
 * @package Mageplaza\HelloWorld\Controller\Adminhtml\Store
 */
class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('store_id');
        
            $model = $this->_objectManager->create(\Mageplaza\HelloWorld\Model\Store::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Store no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Store.'));
                $this->dataPersistor->clear('mageplaza_helloworld_store');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['store_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Store.'));
            }
        
            $this->dataPersistor->set('mageplaza_helloworld_store', $data);
            return $resultRedirect->setPath('*/*/edit', ['store_id' => $this->getRequest()->getParam('store_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

