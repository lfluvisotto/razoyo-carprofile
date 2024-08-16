<?php
declare(strict_types=1);

namespace Razoyo\CarProfile\Controller\Profile;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory as ResultPageFactory;

class Index implements HttpGetActionInterface
{
    public function __construct(
        private readonly ResultPageFactory $resultPageFactory
    ) {
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        $resultPage->getConfig()->getTitle()->set(__('My Car Profile'));

        return $resultPage;
    }
}
