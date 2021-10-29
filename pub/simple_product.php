<?php
use Magento\Framework\App\Bootstrap;

try {
    require __DIR__ . '/../app/bootstrap.php';
} catch (\Exception $e) {
    echo <<<HTML
<div style="font:12px/1.35em arial, helvetica, sans-serif;">
    <div style="margin:0 0 25px 0; border-bottom:1px solid #ccc;">
        <h3 style="margin:0;font-size:1.7em;font-weight:normal;text-transform:none;text-align:left;color:#2f2f2f;">
        Autoload error</h3>
    </div>
    <p>{$e->getMessage()}</p>
</div>
HTML;
    exit(1);
}

$bootstrap = Bootstrap::create(BP, $_SERVER);
/** @var \Magento\Framework\App\Http $app */
$app = $bootstrap->createApplication(\Magento\Framework\App\Http::class);
$bootstrap->run($app);

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$product = $objectManager->create('\Magento\Catalog\Model\Product');
$sku = 'simple-sku';
$product->setSku($sku);
$product->setName('Simple Product');
$product->setAttributeSetId(4);
$product->setStatus(1);
$product->setWeight(120);
$product->setVisibility(4);
$product->setTaxClassId(0);
$product->setTypeId('simple'); // (simple/virtual/downloadable/configurable)
$product->setPrice(90);
//$product->setStoreId(array(1,3));
$product->setWebsiteIds(array(3,1));
//$product->setViewIds(array(1,2));
$product->setStockData(
    array(
        'use_config_manage_stock' => 0,
        'manage_stock' => 1,
        'is_in_stock' => 1,
        'qty' => 45
    )
);
$imagePath = "simple/grouped.png";
$product->addImageToMediaGallery($imagePath, array('image', 'small_image', 'thumbnail'), false, false);
$product->save();
$categoryIds = array('2','4','5');
$category = $objectManager->get('Magento\Catalog\Api\CategoryLinkManagementInterface');
$category->assignProductToCategories($sku, $categoryIds);
