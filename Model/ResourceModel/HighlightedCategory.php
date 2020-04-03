<?php

/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class HighlightedCategory extends AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('aashan_highlighted_categories', 'id');
    }
}

