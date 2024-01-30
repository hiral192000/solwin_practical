<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Solwin\ContactForm\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ContactWidgetRepositoryInterface
{

    /**
     * Save ContactWidget
     * @param \Solwin\ContactForm\Api\Data\ContactWidgetInterface $contactWidget
     * @return \Solwin\ContactForm\Api\Data\ContactWidgetInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Solwin\ContactForm\Api\Data\ContactWidgetInterface $contactWidget
    );

    /**
     * Retrieve ContactWidget
     * @param string $contactwidgetId
     * @return \Solwin\ContactForm\Api\Data\ContactWidgetInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($contactwidgetId);

    /**
     * Retrieve ContactWidget matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Solwin\ContactForm\Api\Data\ContactWidgetSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete ContactWidget
     * @param \Solwin\ContactForm\Api\Data\ContactWidgetInterface $contactWidget
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Solwin\ContactForm\Api\Data\ContactWidgetInterface $contactWidget
    );

    /**
     * Delete ContactWidget by ID
     * @param string $contactwidgetId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($contactwidgetId);
}

