<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\ViewModel;

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Razoyo\CarProfile\Api\CarsInterface;
use Razoyo\CarProfile\Api\Data\CarIndexInterface;
use Razoyo\CarProfile\Api\Data\CarInterface;
use Razoyo\CarProfile\Setup\Patch\Data\AddCustomerAttributeCarProfileId;

class CarProfile implements ArgumentInterface
{
    public function __construct(
        private readonly CustomerSession $customerSession,
        private readonly CarsInterface $cars
    ) {
    }

    public function getId(): string
    {
        return $this->customerSession->getCustomerData()
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
}
