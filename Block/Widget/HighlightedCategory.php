<?php

/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Block\Widget;

use Aashan\HighlightedCategories\Model\ResourceModel\HighlightedCategory\Collection;
use Magento\Catalog\Model\ResourceModel\Category\Collection as CategoryCollection;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;
use Magento\Catalog\Helper\Image;

class HighlightedCategory extends Template implements BlockInterface
{
    protected $_template = "widget/highlightedcategory.phtml";
    /**
     * @var CategoryCollection
     */
    private $categoryCollection;
    /**
     * @var Collection
     */
    private $highlightCollection;
    /**
     * @var Image
     */
    private $imageHelper;

    /**
     * Constructor
     *
     * @param Context $context
     * @param CategoryCollection $categoryCollection
     * @param Collection $highlightCollection
     * @param Image $imageHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        CategoryCollection $categoryCollection,
        Collection $highlightCollection,
        Image $imageHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->categoryCollection = $categoryCollection;
        $this->highlightCollection = $highlightCollection;
        $this->categoryCollection->addFieldToSelect('name');
        $this->imageHelper = $imageHelper;
    }

    /**
     * @return array
     */
    public function getHighlights()
    {
        $highlightIds = explode(',', $this->getData('highlightIds'));
        $highlights = [];
        foreach ($highlightIds as $highlightId) {
            $childCategories = [];
            $highlight = $this->highlightCollection->getItemById($highlightId);
            $childCategoryIds = json_decode($highlight->getData('child_categories'));
            foreach ($childCategoryIds as $childCategoryId) {
                $childCategories[$childCategoryId] = $this->categoryCollection->getItemById($childCategoryId);
            }
            $highlights[$highlightId] = [
                'id' => $highlight->getId(),
                'code' => $highlight->getData('code'),
                'parent_category' => $this->categoryCollection->getItemById($highlight->getData('parent_category')),
                'child_categories' => $childCategories,
                'expires_on' => $highlight->getData('expires_on'),
            ];
        }
        return $highlights;
    }

    public function getImageUrl()
    {
        return $this->imageHelper->getDefaultPlaceholderUrl();
    }
}
