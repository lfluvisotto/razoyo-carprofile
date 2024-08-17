<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Controller\Profile;

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\RedirectFactory as ResultRedirectFactory;
use Magento\Framework\View\Result\PageFactory as ResultPageFactory;

class Edit implements HttpGetActionInterface
{
    public function __construct(
        private readonly CustomerSession $customerSession,
        private readonly ResultRedirectFactory $resultRedirectFactory,
        private readonly ResultPageFactory $resultPageFactory
    ) {
    }

    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->resultRedirectFactory->create()->setPath('customer/account/login');
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('My Car Profile'));

        $customerAccountNavigation = $resultPage->getLayout()->getBlock('customer_account_navigation');

        if ($customerAccountNavigation) {
            $customerAccountNavigation->setActive(Index::PATH);
        }

        return $resultPage;
    }
}
