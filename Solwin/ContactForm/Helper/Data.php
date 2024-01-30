<?php

namespace Solwin\ContactForm\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

     /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Module\Manager $moduleManager,
    ) {
        $this->_storeManager = $storeManager;
        $this->moduleManager = $moduleManager;
        parent::__construct($context);
    }

    /**
     * Get config value
     */
    public function getConfigValue($value = '')
    {
        return $this->scopeConfig
                ->getValue(
                    $value,
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                );
    }

    /**
     * Get base url
     */
    public function getBaseUrl()
    {
        return $this->_storeManager
                ->getStore()
                ->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                );
    }

    /**
     * Get current url
     */
    public function getCurrentUrl()
    {
        return $this->_urlBuilder->getCurrentUrl();
    }

    /**
     * Get module status
     */
    public function getIsModuleEnabled($value)
    {
        return $this->moduleManager->isOutputEnabled($value);
    }
}
