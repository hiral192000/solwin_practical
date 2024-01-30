<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Solwin\ContactForm\Model;

use Magento\Framework\Model\AbstractModel;
use Solwin\ContactForm\Api\Data\ContactWidgetInterface;

class ContactWidget extends AbstractModel implements ContactWidgetInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Solwin\ContactForm\Model\ResourceModel\ContactWidget::class);
    }

    /**
     * @inheritDoc
     */
    public function getContactwidgetId()
    {
        return $this->getData(self::CONTACTWIDGET_ID);
    }

    /**
     * @inheritDoc
     */
    public function setContactwidgetId($contactwidgetId)
    {
        return $this->setData(self::CONTACTWIDGET_ID, $contactwidgetId);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
}

