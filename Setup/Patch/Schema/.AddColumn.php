<?php
namespace Mcraen\Tmodule\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Framework\Db\Ddl\Table;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;

class AddColumn implements SchemaPatchInterface
{
    private $_moduleSetup;

    public function __construct(ModuleDataSetupInterface $moduleSetup)
    {
        $this->_moduleSetup = $moduleSetup;
    }

    public static function getDependencies()
    {
        // TODO: Implement getDependencies() method.
    }

    public function getAliases()
    {
        // TODO: Implement getAliases() method.
    }

    public function apply()
    {
        $this->_moduleSetup->startSetup();

        $this->_moduleSetup->getConnection()->addColumn(
            $this->_moduleSetup->getTable('catalog_product_entity'),'content',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 255,
                'nullable' => true,
                'comment' => 'Content',
            ]
        );
    }
}
