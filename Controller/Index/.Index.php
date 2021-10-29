<?php
namespace Macraen\Tmodule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Macraen\Tmodule\Helper\Data;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Index extends Action
{
    protected $_customerSession;

    protected $customerSession;
    public $response;

    /**
     * Construct
     *
     * @param \Magento\Framework\App\Action\ $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\App\Response\Http $response
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Response\Http $response
    ) {
        $this->response = $response;
        $this->customerSession = $customerSession;
        return parent::__construct($context);
    }

    public function _prepareLayout()
    {
        if($this->customerSession->getCustomer()->getGroupId() == 3){
            return __('Hello World');
        }else{
            $this->response->setRedirect('/');
        }
        return parent::_prepareLayout();
    }

    public function execute()
    {
        if($this->customerSession->getCustomer()->getGroupId() == 3){
            $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            return $page;
        }else{
//            return $this->response->setRedirect('/');
            return $this->_redirect('customer/account/');
        }
    }
}
