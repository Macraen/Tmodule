<?php
namespace Macraen\Tmodule\Plugin;

class Product{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result){
        return "[BEST] ".$result;
    }
}