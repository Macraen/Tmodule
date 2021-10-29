<?php
namespace Macraen\Tmodule\Block;
class Display extends \Magento\Framework\View\Element\Template
{
    protected $customerSession;
    public $response;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Response\Http $response,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->response = $response;
        $this->customerSession = $customerSession;
    }

    public function _prepareLayout()
    {
        if($this->customerSession->getCustomer()->getGroupId() == 3){
            return __('Hello World');
        } else {
            return __('');
        }
    }

    public function sayHello()
    {
        return __('Hello World');
    }
}
