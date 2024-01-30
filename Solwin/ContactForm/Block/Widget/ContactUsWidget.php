<?php

namespace Solwin\ContactForm\Block\Widget;

class ContactUsWidget extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->setTemplate('widget/customcontact_widget.phtml');
    }

    /**
     * Get form action url
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('contactuswidget/widget/index');
    }

    /**
     * Get config value
     */
    public function getConfigValue($value = '')
    {
        return $this->_scopeConfig
                ->getValue(
                    $value,
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                );
    }
}
