<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddCustomerAttributeCarProfileId implements DataPatchInterface
{
    public const CAR_PROFILE_ID = 'car_profile_id';
    public const TABLE_CUSTOMER_FORM_ATTRIBUTE = 'customer_form_attribute';

    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly CustomerSetupFactory $customerSetupFactory
    ) {
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create();

        $customerSetup->addAttribute(
            Customer::ENTITY,
            self::CAR_PROFILE_ID,
            [
                'type' => 'varchar',
                'label' => 'Car Profile ID',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'system' => false,
                'user_defined' => true,
                'group' => 'General',
                'sort_order' => 999,
            ]
        );

        $connection = $this->moduleDataSetup->getConnection();
        $connection->insert(
            $connection->getTableName(self::TABLE_CUSTOMER_FORM_ATTRIBUTE),
            [
                'form_code' => 'adminhtml_customer',
                'attribute_id' => $customerSetup->getAttributeId('customer', self::CAR_PROFILE_ID)
            ]
        );

        return $this;
    }
}
