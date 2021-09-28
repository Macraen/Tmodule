<?php
namespace Magento\Tmodule\Plugin;

 class Cart {
    public function beforeAddProduct(\Magento\Checkout\Model\Cart $subject, $productInfo, $requestInfo = null){
        $requestInfo['qty'] = 3;
        $result = array($productInfo, $requestInfo);
        return $result;
    }
//    public function aroundAddProduct(\Magento\Checkout\Model\Cart $subject,\Closure $proceed, $productInfo, $requestInfo = null){
//        $requestInfo['qty'] = 5;
//        $result = $proceed($productInfo, $requestInfo);
//        return $result;
//    }
//
//     public function afterAddProduct(\Magento\Checkout\Model\Cart $subject, $productInfo, $requestInfo = null){
//         $requestInfo['qty'] = 2;
//         $result = array($productInfo, $requestInfo);
//         return $result;
//     }
 }



