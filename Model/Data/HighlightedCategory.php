<?php

/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Model\Data;

use Aashan\HighlightedCategories\Api\Data\HighlightedCategoryExtensionInterface;
use Aashan\HighlightedCategories\Api\Data\HighlightedCategoryInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

class HighlightedCategory extends AbstractExtensibleObject implements HighlightedCategoryInterface
{

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($highlightedCategoryId)
    {
        $this->_data[self::ID] = $highlightedCategoryId;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getParentCategory()
    {
        return $this->_get(self::PARENT_CATEGORY);
    }

    /**
     * @inheritDoc
     */
    public function setParentCategory($categoryId)
    {
        $this->_data[self::PARENT_CATEGORY] = $categoryId;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getCode()
    {
        return $this->_get(self::CODE);
    }

    /**
     * @inheritDoc
     */
    public function setCode($code)
    {
        $this->_data[self::CODE] = $code;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getChildCategories()
    {
        $data =  json_decode($this->_get(self::CHILDD_CATEGORIES));
        if (json_last_error() == JSON_ERROR_NONE) {
            return $data;
        }
        return [];
    }

    /**
     * @inheritDoc
     */
    public function setChildCategories($childCategories)
    {
        $this->_data[self::CHILD_CATEGORIES] = json_encode($childCategories);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getExpiryDate()
    {
        $this->_get(self::EXPIRES_ON);
    }

    /**
     * @inheritDoc
     */
    public function setExpiryDate($expiryDate)
    {
        $this->_data[self::EXPIRES_ON] = $expiryDate;
        return $this;
    }
}
