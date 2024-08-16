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
namespace Dss\StoreviewFlags\Model\Config\Backend;

use Magento\Config\Model\Config\Backend\File;

class FileAllow extends File
{
    /**
     * GetAllowedExtensions
     *
     * @return array
     */
    public function getAllowedExtensions(): array
    {
        return ['jpg', 'jpeg', 'gif', 'png'];
    }
}
