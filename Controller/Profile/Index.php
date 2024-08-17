<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Controller\Profile;

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\RedirectFactory as ResultRedirectFactory;
use Magento\Framework\View\Result\PageFactory as ResultPageFactory;

class Index implements HttpGetActionInterface
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

        return $resultPage;
    }
}
