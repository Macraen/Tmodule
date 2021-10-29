<?php
namespace Macraen\Tmodule\Block\Adminhtml\Grid\Edit\Buttons;

use Macraen\Tmodule\Block\Adminhtml\Grid\Edit\Buttons\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Delete'),
            'on_click' => 'deleteConfirm(\'' . __('Are you sure you want to delete this log?') . '\', \'' . $this->getDeleteUrl() . '\')',
            'class' => 'delete',
            'sort_order' => 20
        ];
    }

//    public function getDeleteUrl()
//    {
//        $id = $this->getObjectId();
//        return $this->getUrl('*/*/deleterow', ['id' => 76]);
//    }
}
