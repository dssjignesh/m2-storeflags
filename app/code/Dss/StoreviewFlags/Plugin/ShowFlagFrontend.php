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

use Magento\Store\Block\Switcher;
use Dss\StoreviewFlags\Helper\Data;

class ShowFlagFrontend
{
    /**
     * ShowFlagFrontend constructor.
     *
     * @param \Dss\StoreviewFlags\Helper\Data $helper
     */
    public function __construct(
        protected Data $helper
    ) {
    }

    /**
     * Plugin After
     *
     * @param \Magento\Store\Block\Switcher $subject
     * @param array $result
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterGetStores(Switcher $subject, $result): array
    {
        $data = [];
        if ($this->helper->getEndableModule()) {
            $storeIds = array_keys($result);
            foreach ($storeIds as $storeId) {
                if ($this->helper->getUrlImageFlag($storeId)) {
                    $data[$storeId] = [ 'width'  => $this->helper->getWidth($storeId),
                                        'height' => $this->helper->getHeight($storeId),
                                        'image'  => $this->helper->getUrlImageFlag($storeId),
                                        'show_label' => $this->helper->getShowStoreviewName($storeId)
                                        ];
                }
            }
        }
        $subject->setData('store_view_flag', $data);
        return $result;
    }
}
