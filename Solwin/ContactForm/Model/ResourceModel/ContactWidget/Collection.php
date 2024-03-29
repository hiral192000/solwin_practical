<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Solwin\ContactForm\Model\ResourceModel\ContactWidget;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'contactwidget_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Solwin\ContactForm\Model\ContactWidget::class,
            \Solwin\ContactForm\Model\ResourceModel\ContactWidget::class
        );
    }
}

