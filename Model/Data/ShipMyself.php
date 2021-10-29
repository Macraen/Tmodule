<?php
namespace Macraen\Tmodule\Model\Data;
use Macraen\Tmodule\Api\Data\ShipmentMyselfInterface;
use Macraen\Tmodule\Setup\SchemaInformation;
use Magento\Framework\Api\AbstractSimpleObject;
/**
 * Class ShipMyself
 */
class ShipMyself extends AbstractSimpleObject implements ShipmentMyselfInterface
{
    /**
     * @inheritdoc
     */
    public function getShipMyself()
    {
        return $this->_get(SchemaInformation::ATTRIBUTE_SHIPPING_MYSELF);
    }
    /**
     * @inheritdoc
     */
    public function setShipMyself($shipMyself)
    {
        return $this->setData(SchemaInformation::ATTRIBUTE_SHIPPING_MYSELF, $shipMyself);
    }
}
