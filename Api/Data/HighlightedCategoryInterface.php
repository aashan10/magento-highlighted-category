<?php

/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface HighlightedCategoryInterface extends ExtensibleDataInterface
{
    const ID = 'id';
    const PARENT_CATEGORY = 'parent_category';
    const CHILD_CATEGORIES = 'child_categories';
    const CODE = 'code';
    const EXPIRES_ON = 'expires_on';

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $highlightedCategoryId
     * @return HighlightedCategoryInterface
     */
    public function setId($highlightedCategoryId);

    /**
     * Get parent category
     * @return string|null
     */
    public function getParentCategory();

    /**
     * Set parent category
     * @param string $categoryId
     * @return HighlightedCategoryInterface
     */
    public function setParentCategory($categoryId);

    /**
     * Get code
     * @return string|null
     */
    public function getCode();

    /**
     * Set code
     * @param string $code
     * @return HighlightedCategoryInterface
     */
    public function setCode($code);

    /**
     * Get Child Categories
     * @return array|null
     */
    public function getChildCategories();

    /**
     * Set Child Categories
     * @param $childCategories
     * @return HighlightedCategoryInterface
     */
    public function setChildCategories($childCategories);

    /**
     * @return string | null
     */
    public function getExpiryDate();

    /**
     * @param $expiryDate
     * @return HighlightedCategoryInterface
     */
    public function setExpiryDate($expiryDate);
}
