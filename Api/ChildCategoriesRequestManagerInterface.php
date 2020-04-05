<?php

/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Api;

use Magento\Framework\Webapi\Rest\Response;


interface ChildCategoriesRequestManagerInterface
{
    /**
     * Fetch data for web api requests.
     * @return Response
     */
    public function getData();
}
