<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Solwin\ContactForm\Api\Data;

interface ContactWidgetSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get ContactWidget list.
     * @return \Solwin\ContactForm\Api\Data\ContactWidgetInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Solwin\ContactForm\Api\Data\ContactWidgetInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

