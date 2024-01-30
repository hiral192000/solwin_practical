<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Solwin\ContactForm\Api\Data;

interface ContactWidgetInterface
{

    const NAME = 'name';
    const CONTACTWIDGET_ID = 'contactwidget_id';

    /**
     * Get contactwidget_id
     * @return string|null
     */
    public function getContactwidgetId();

    /**
     * Set contactwidget_id
     * @param string $contactwidgetId
     * @return \Solwin\ContactForm\ContactWidget\Api\Data\ContactWidgetInterface
     */
    public function setContactwidgetId($contactwidgetId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Solwin\ContactForm\ContactWidget\Api\Data\ContactWidgetInterface
     */
    public function setName($name);
}

