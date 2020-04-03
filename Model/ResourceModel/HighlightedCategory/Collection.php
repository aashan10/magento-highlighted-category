<?php

/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Model\ResourceModel\HighlightedCategory;

use Aashan\HighlightedCategories\Model\HighlightedCategory;
use Aashan\HighlightedCategories\Model\ResourceModel\HighlightedCategory as HighlightedCategoryResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            HighlightedCategory::class,
            HighlightedCategoryResourceModel::class
        );
    }
}

