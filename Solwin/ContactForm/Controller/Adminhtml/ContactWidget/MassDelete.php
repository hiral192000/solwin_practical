<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Solwin\ContactForm\Controller\Adminhtml\ContactWidget;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Solwin\ContactForm\Model\ResourceModel\ContactWidget\CollectionFactory;

class MassDelete extends Action
{
    /**
     * @var Solwin\ContactForm\Model\ResourceModel\ContactWidget\CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var Magento\Ui\Component\MassAction\Filter
     */
    protected $filter;
    /**
     * Dependency Initilization
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
    /**
     * Provides content
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $count = 0;
            foreach ($collection as $model) {
                $model->delete();
                $count++;
            }
            $this->messageManager->addSuccess(__('A total of %1 Contact(s) have been deleted.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
    /**
     * Check Autherization
     *
     * @return boolean
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Solwin_ContactForm::delete');
    }
}