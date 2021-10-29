<?php
namespace Macraen\Tmodule\Controller\Adminhtml\Grid;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Macraen\Tmodule\Model\Grid;

class DeleteRow extends Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                $model = $this->_objectManager->create('Macraen\Tmodule\Model\Grid');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Offline customer has been deleted.'));
                return $resultRedirect->setPath('*/*/index');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        return $resultRedirect->setPath('*/*/index');
    }
}
