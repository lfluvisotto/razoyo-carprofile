<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Controller\Profile;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\RedirectFactory as ResultRedirectFactory;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\State\InputMismatchException;
use Magento\Framework\Message\ManagerInterface as MessageManager;
use Psr\Log\LoggerInterface;
use Razoyo\CarProfile\Api\CarsInterface;
use Razoyo\CarProfile\Api\Data\CarIndexInterface;
use Razoyo\CarProfile\Setup\Patch\Data\AddCustomerAttributeCarProfileId;

class Save implements HttpGetActionInterface
{
    public function __construct(
        private readonly CustomerSession $customerSession,
        private readonly ResultRedirectFactory $resultRedirectFactory,
        private readonly RequestInterface $request,
        private readonly CarsInterface $cars,
        private readonly CustomerRepositoryInterface $customerRepository,
        private readonly MessageManager $messageManager,
        private readonly LoggerInterface $logger
    ) {
    }

    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->resultRedirectFactory->create()->setPath('customer/account/login');
        }

        $id = $this->request->getParam(CarIndexInterface::ID);

        if ($id) {
            $car = $this->cars->getCar($id);

            if ($car->getId()) {
                $this->customerSession->getCustomerData()
                    ->setCustomAttribute(AddCustomerAttributeCarProfileId::CAR_PROFILE_ID, $id);

                try {
                    $this->customerRepository->save($this->customerSession->getCustomerData());

                    $this->messageManager->addSuccessMessage(__('Car profile saved.'));
                } catch (InputException|NoSuchEntityException|InputMismatchException|LocalizedException $exception) {
                    $this->logger->error($exception->getTraceAsString());

                    $this->messageManager->addErrorMessage(__('Car profile has not been saved.'));
                }
            } else {
                $this->messageManager->addErrorMessage(__('Invalid car profile ID.'));
            }
        }

        return $this->resultRedirectFactory->create()->setPath(Index::PATH);
    }
}
