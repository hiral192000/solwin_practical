<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Solwin\ContactForm\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Solwin\ContactForm\Api\ContactWidgetRepositoryInterface;
use Solwin\ContactForm\Api\Data\ContactWidgetInterface;
use Solwin\ContactForm\Api\Data\ContactWidgetInterfaceFactory;
use Solwin\ContactForm\Api\Data\ContactWidgetSearchResultsInterfaceFactory;
use Solwin\ContactForm\Model\ResourceModel\ContactWidget as ResourceContactWidget;
use Solwin\ContactForm\Model\ResourceModel\ContactWidget\CollectionFactory as ContactWidgetCollectionFactory;

class ContactWidgetRepository implements ContactWidgetRepositoryInterface
{

    /**
     * @var ResourceContactWidget
     */
    protected $resource;

    /**
     * @var ContactWidgetInterfaceFactory
     */
    protected $contactWidgetFactory;

    /**
     * @var ContactWidgetCollectionFactory
     */
    protected $contactWidgetCollectionFactory;

    /**
     * @var ContactWidget
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceContactWidget $resource
     * @param ContactWidgetInterfaceFactory $contactWidgetFactory
     * @param ContactWidgetCollectionFactory $contactWidgetCollectionFactory
     * @param ContactWidgetSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceContactWidget $resource,
        ContactWidgetInterfaceFactory $contactWidgetFactory,
        ContactWidgetCollectionFactory $contactWidgetCollectionFactory,
        ContactWidgetSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->contactWidgetFactory = $contactWidgetFactory;
        $this->contactWidgetCollectionFactory = $contactWidgetCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(ContactWidgetInterface $contactWidget)
    {
        try {
            $this->resource->save($contactWidget);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the contactWidget: %1',
                $exception->getMessage()
            ));
        }
        return $contactWidget;
    }

    /**
     * @inheritDoc
     */
    public function get($contactWidgetId)
    {
        $contactWidget = $this->contactWidgetFactory->create();
        $this->resource->load($contactWidget, $contactWidgetId);
        if (!$contactWidget->getId()) {
            throw new NoSuchEntityException(__('ContactWidget with id "%1" does not exist.', $contactWidgetId));
        }
        return $contactWidget;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->contactWidgetCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(ContactWidgetInterface $contactWidget)
    {
        try {
            $contactWidgetModel = $this->contactWidgetFactory->create();
            $this->resource->load($contactWidgetModel, $contactWidget->getContactwidgetId());
            $this->resource->delete($contactWidgetModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the ContactWidget: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($contactWidgetId)
    {
        return $this->delete($this->get($contactWidgetId));
    }
}

