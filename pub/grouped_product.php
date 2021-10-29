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
$product = $objectManager->create(Magento\Catalog\Model\Product::class);
$sku = 'sku11';
$product->setSku($sku);
$product->setName('Grouped Product');
$product->setWeight(100);
$product->setPrice(170);
$product->setDescription('description');
$product->setAttributeSetId(4);
$product->setCategoryIds(array(5));
$product->setStatus(1);
$product->setVisibility(4);
$product->setTaxClassId(1);
$product->setTypeId('grouped');
//$product->setStoreId(1);
$product->setWebsiteIds(array(3,1));
$product->setVisibility(4);
$product->setImage('simple/grouped.webp');
$product->setSmallImage('simple/grouped.webp');
$product->setThumbnail('simple/grouped.webp');
$product->setStockData(array(
        'use_config_manage_stock' => 0,
        'manage_stock' => 1,
        'min_sale_qty' => 1,
        'max_sale_qty' => 2,
        'is_in_stock' => 1,
        'qty' => 1000
    )
);
$product->save();

$childrenIds = [5, 34];
$associated = [];
$position = 0;
foreach ($childrenIds as $productId)
{
    $position++;
    $linkedProduct = $objectManager->get('\Magento\Catalog\Api\ProductRepositoryInterface')->getById($productId);
    $productLink = $objectManager->create('\Magento\Catalog\Api\Data\ProductLinkInterface');
    $productLink->setSku($product->getSku())
        ->setLinkType('associated')
        ->setLinkedProductSku($linkedProduct->getSku())
        ->setLinkedProductType($linkedProduct->getTypeId())
        ->setPosition($position)
        ->getExtensionAttributes()
        ->setQty(1);
    $associated[] = $productLink;
}
$product->setProductLinks($associated);
$product->save();
$categoryIds = array(5);
$category = $objectManager->get('Magento\Catalog\Api\CategoryLinkManagementInterface');
$category->assignProductToCategories($sku, $categoryIds);
if ($product->getId())
{
    echo "Product Created";
}
