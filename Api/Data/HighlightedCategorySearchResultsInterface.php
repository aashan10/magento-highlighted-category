<?php

/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface HighlightedCategorySearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get HighlightedCategory list.
     * @return HighlightedCategoryInterface[]
     */
    public function getItems();

    /**
     * Set category_id list.
     * @param HighlightedCategoryInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

