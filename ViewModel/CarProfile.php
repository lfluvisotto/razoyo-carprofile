<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\ViewModel;

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Razoyo\CarProfile\Api\CarsInterface;
use Razoyo\CarProfile\Api\Data\CarIndexInterface;
use Razoyo\CarProfile\Api\Data\CarInterface;
use Razoyo\CarProfile\Setup\Patch\Data\AddCustomerAttributeCarProfileId;

class CarProfile implements ArgumentInterface
{
    public function __construct(
        private readonly CustomerSession $customerSession,
        private readonly CarsInterface $cars,
        private readonly UrlInterface $url,
        private readonly PriceCurrencyInterface $priceCurrency,
    ) {
    }

    public function getId(): string
    {
        return (string)$this->customerSession->getCustomerData()
            ->getCustomAttribute(AddCustomerAttributeCarProfileId::CAR_PROFILE_ID)?->getValue();
    }

    /**
     * @return CarIndexInterface[]
     */
    public function getCars(): array
    {
        return $this->cars->getCars();
    }

    public function getCar(): CarInterface
    {
        return $this->cars->getCar($this->getId());
    }

    public function getEditUrl(): string
    {
        return $this->url->getUrl('car/profile/edit');
    }

    public function getSaveUrl(string $id): string
    {
        return $this->url->getUrl('car/profile/save', ['id' => $id]);
    }

    public function formatPrice(float $price): string
    {
        return $this->priceCurrency->format($price, false);
    }
}
