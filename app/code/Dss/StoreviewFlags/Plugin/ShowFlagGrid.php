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
namespace Dss\StoreviewFlags\Plugin;

use Dss\StoreviewFlags\Helper\Data;
use Magento\Backend\Block\System\Store\Grid\Render\Store;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;

class ShowFlagGrid
{
    /**
     * ShowFlagGrid constructor.
     *
     * @param \Dss\StoreviewFlags\Helper\Data $helper
     */
    public function __construct(
        protected Data $helper
    ) {
    }

    /**
     * AroundRender
     *
     * @param \Magento\Backend\Block\System\Store\Grid\Render\Store $subject
     * @param callable $proceed
     * @param \Magento\Framework\DataObject $row
     * @return string|null
     * @throws NoSuchEntityException
     */
    public function aroundRender(Store $subject, callable $proceed, DataObject $row): ?string
    {
        if (!$this->helper->getEndableModule()) {
            return $proceed($row);
        }

        if (!$row->getData($subject->getColumn()->getIndex())) {
            return null;
        }

        $urlImage = $this->helper->getUrlImageFlag($row->getStoreId());
        if ($urlImage) {
            $urlImage = '<img class="dss-flag" src="' . $urlImage . '">';
        }

        return
            $urlImage .
            '<a title="' . __(
                'Edit Store View'
            ) . '"
            href="' .
            $subject->getUrl('adminhtml/*/editStore', ['store_id' => $row->getStoreId()]) .
            '">' .
            $subject->escapeHtml($row->getData($subject->getColumn()->getIndex())) .
            '</a><br />' .
            '(' . __('Code') . ': ' . $row->getStoreCode() . ')';
    }
}
