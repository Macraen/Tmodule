<?php
namespace Macraen\Tmodule\Controller\Index;

use Magento\Framework\App\Action\Context;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class Post extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_cart;
    protected $_productRepositoryInterface;
    protected $_url;
    protected $_responseFactory;
    protected $_logger;


    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_cart = $cart;
        $this->_productRepositoryInterface = $productRepositoryInterface;
        $this->_responseFactory = $responseFactory;
        $this->_url = $context->getUrl();
        $this->_logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $productid = 1;

        $_product = $this->_productRepositoryInterface->getById($productid);
        $options = $_product->getOptions();

        $customoptions = array();
//        $customoptions['my_custom_option'] = 'demo';

        $params = array (
            'product' => $_product->getId(),
            'qty' => 1,
            'price' => $_product->getPrice(),
            'options' => $customoptions
        );

        $this->_cart->addProduct($_product, $params);
        $this->_cart->save();

        $this->_redirect('checkout/cart/index');
    }

}
