<?php
namespace Macraen\Tmodule\Api;
/**
 * Interface for saving the checkout note to the quote for orders
 *
 * @api
 */
interface ShipMyselfManagementInterface
{
    /**
     * @param int $cartId
     * @param \Macraen\Tmodule\Api\Data\ShipmentMyselfInterface $shipMyself
     *
     * @return string
     */
    public function saveShipMyself(
        $cartId,
        \Macraen\Tmodule\Api\Data\ShipmentMyselfInterface $shipMyself
    );
}
