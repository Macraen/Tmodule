<?php
namespace Macraen\Tmodule\Model;
use Macraen\Tmodule\Api\Data\ShipmentMyselfInterface;
use Macraen\Tmodule\Api\ShipMyselfManagementInterface;
use Macraen\Tmodule\Setup\SchemaInformation;
use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
/**
 * Class ShipMyselfManagement
 */
class ShipMyselfManagement implements ShipMyselfManagementInterface
{
    /**
     * Quote repository.
     *
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;
    /**
     * ShipMyselfManagement constructor.
     *
     * @param CartRepositoryInterface $quoteRepository
     */
    public function __construct(CartRepositoryInterface $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }
    /**
     * Save simple note number in the quote
     *
     * @param int $cartId
     * @param ShipmentMyselfInterface $shipMyself
     *
     * @return null|string
     *
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function saveShipMyself(
        $cartId,
        ShipmentMyselfInterface $shipMyself
    ) {
        $quote = $this->quoteRepository->getActive($cartId);
        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
        }
        $sn = $shipMyself->getShipMyself();
        try {
            $quote->setData(SchemaInformation::ATTRIBUTE_SHIPPING_MYSELF, strip_tags($sn));
            $this->quoteRepository->save($quote);
        } catch (Exception $e) {
            throw new CouldNotSaveException(__('The simple note # number could not be saved'));
        }
        return $sn;
    }
}
