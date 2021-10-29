<?php
namespace Macraen\Tmodule\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class AddProductToCart extends \Magento\Customer\Controller\AbstractAccount
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var \Magento\Framework\Data\Form\FormKey
     */
    protected $formKey;
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->formKey = $formKey;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $params = array(
            'form_key' => $this->formKey->getFormKey(),
            'product' =>5,//product Id
            'qty'   =>1,//quantity of product
            'price' =>100 //product price
        );
        $this->_redirect("checkout/cart/add/form_key/", $params);
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        return $resultPage;
    }
}
