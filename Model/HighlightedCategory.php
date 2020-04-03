<?php

/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Model;

use Aashan\HighlightedCategories\Api\Data\HighlightedCategoryInterface;
use Aashan\HighlightedCategories\Api\Data\HighlightedCategoryInterfaceFactory;
use Aashan\HighlightedCategories\Model\ResourceModel\HighlightedCategory\Collection;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;

class HighlightedCategory extends AbstractModel
{
    /**
     * @var HighlightedCategoryInterfaceFactory
     */
    protected $highlightedCategoryDataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    protected $_eventPrefix = 'aashan_highlighted_categories';

    /**
     * @param Context $context
     * @param Registry $registry
     * @param HighlightedCategoryInterfaceFactory $highlightedCategoryDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\HighlightedCategory $resource
     * @param Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        HighlightedCategoryInterfaceFactory $highlightedCategoryDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\HighlightedCategory $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        $this->highlightedCategoryDataFactory = $highlightedCategoryDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve HighlightedCategory model with data
     * @return HighlightedCategoryInterface
     */
    public function getDataModel()
    {
        $highlightedCategoryData = $this->getData();

        $highlightedCategoryDataObject = $this->highlightedCategoryDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $highlightedCategoryDataObject,
            $highlightedCategoryData,
            HighlightedCategoryInterface::class
        );

        return $highlightedCategoryDataObject;
    }
}
