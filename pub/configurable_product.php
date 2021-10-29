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
$configurableproduct = $objectManager->create('Magento\Catalog\Model\Product');
$configurableproduct->setSku("configurable_sku"); // set Your SKU
$configurableproduct->setName("Configurable Name"); // set Your Configurable Name
$configurableproduct->setAttributeSetId(4); // set attribute id
$configurableproduct->setStatus(1); // status enabled/disabled 1/0
$configurableproduct->setTypeId('configurable'); // type of product (simple/virtual/downloadable/configurable)
$configurableproduct->setVisibility(4);  // visibility of product (Not Visible Individually (1) / Catalog (2)/ Search (3)/ Catalog, Search(4))
$configurableproduct->setPrice(0);
$configurableproduct->setTaxClassId(0); // Tax class ID
$configurableproduct->setWebsiteIds(array(1,3)); // set website Id
$category_id = array(2, 3);
$configurableproduct->setCategoryIds($category_id);
$configurableproduct->setStockData(array(
        'use_config_manage_stock' => 0,
        'manage_stock' => 1,
        'is_in_stock' => 1,
    )
);
$configurableattributesdata = $configurableproduct->getTypeInstance()->getConfigurableAttributesAsArray($configurableproduct);
$configurableproduct->setCanSaveConfigurableAttributes(true);
$configurableproduct->setConfigurableAttributesData($configurableattributesdata);
$configurableproductsdata = array();
$configurableproduct->setConfigurableProductsData($configurableproductsdata);
try {
    $configurableproduct->save();
} catch (Exception $ex) {
    echo '<pre>';
    print_r($ex->getMessage());
    exit(1);
}
$product_id = $configurableproduct->getId();
$associatedproductids = array(1,9);
try {
    $configurableproduct_load = $objectManager->create('Magento\Catalog\Model\Product')->load($product_id);
    $configurableproduct_load->setAssociatedProductIds($associatedproductids);
    $configurableproduct_load->setCanSaveConfigurableAttributes(true);
    $configurableproduct_load->save();
    echo "configurable product save successfully";
} catch (Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    exit(1);
}
