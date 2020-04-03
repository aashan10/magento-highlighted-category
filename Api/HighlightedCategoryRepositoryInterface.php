<?php

/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Api;

use Aashan\HighlightedCategories\Api\Data\HighlightedCategoryInterface;
use Aashan\HighlightedCategories\Api\Data\HighlightedCategorySearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Interface HighlightedCategoryRepositoryInterface
 *
 * @package Aashan\HighlightedCategories\Api
 */
interface HighlightedCategoryRepositoryInterface
{

    /**
     * Save HighlightedCategory
     * @param HighlightedCategoryInterface $highlightedCategory
     * @return HighlightedCategoryInterface
     * @throws LocalizedException
     */
    public function save(
        HighlightedCategoryInterface $highlightedCategory
    );

    /**
     * Retrieve HighlightedCategory
     * @param string $highlightedCategoryId
     * @return HighlightedCategoryInterface
     * @throws LocalizedException
     */
    public function get($highlightedCategoryId);

    /**
     * Retrieve HighlightedCategory matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return HighlightedCategorySearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete HighlightedCategory
     * @param HighlightedCategoryInterface $highlightedCategory
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        HighlightedCategoryInterface $highlightedCategory
    );

    /**
     * Delete HighlightedCategory by ID
     * @param string $highlightedCategoryId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById($highlightedCategoryId);
}

