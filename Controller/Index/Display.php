<?php
namespace Macraen\Tmodule\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Display extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory, $customerSession, $response;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Response\Http $response)
    {
        $this->response = $response;
        $this->customerSession = $customerSession;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        if($this->customerSession->getCustomer()->getGroupId() == 3){
            $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            return $page;
        }else{
            return $this->_redirect('customer/account/');
        }
//        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
//        return $page;
//        return $this->_pageFactory->create();

    }
}
