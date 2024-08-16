<?php

declare(strict_types=1);

/**
* Digit Software Solutions.
*
* NOTICE OF LICENSE
*
* This source file is subject to the EULA
* that is bundled with this package in the file LICENSE.txt.
*
* @category  Dss
* @package   Dss_StoreviewFlags
* @author    Extension Team
* @copyright Copyright (c) 2024 Digit Software Solutions. ( https://digitsoftsol.com )
*/
namespace Dss\StoreviewFlags\Helper;

use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Exception\NoSuchEntityException;

class Data extends AbstractHelper
{
    /**
     * Data constructor.
     *
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        protected StoreManagerInterface $storeManager,
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * GetEndableModule
     *
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getEndableModule()
    {
        return $this->scopeConfig->getValue(
            'storeflag/general/enable_module',
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
    }

    /**
     * GetUpload
     *
     * @param int|null $storeId
     * @return string|bool
     * @throws NoSuchEntityException
     */
    public function getUrlImageFlag($storeId = null): string|bool
    {
        $imgUrl = $this->scopeConfig
            ->getValue('storeflag/image/uploadflag', ScopeInterface::SCOPE_STORE, $storeId);
        if ($imgUrl != '') {
            return $this->storeManager->getStore($storeId)
                   ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'dssstoresflags/' . $imgUrl;
        }
        return false;
    }

    /**
     * GetStoreId
     *
     * @return int|string
     * @throws NoSuchEntityException
     */
    public function getStoreId(): int|string
    {
        return $this->storeManager->getStore()->getId();
    }

    /**
     * GetHeight
     *
     * @param int|null $storeId
     * @return string|int
     */
    public function getHeight($storeId = null): string|int
    {
        return $this->scopeConfig->getValue(
            'storeflag/image/imgheight',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * GetWidth
     *
     * @param int|null $storeId
     * @return string|int
     */
    public function getWidth($storeId = null): string|int
    {
        return $this->scopeConfig->getValue(
            'storeflag/image/imgwidth',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get Storeview Name
     *
     * @param int|null $storeId
     * @return string
     */
    public function getShowStoreviewName($storeId = null): string
    {
        return $this->scopeConfig->getValue(
            'storeflag/store_name/enable_name',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
