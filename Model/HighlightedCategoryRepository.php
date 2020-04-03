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
use Aashan\HighlightedCategories\Api\Data\HighlightedCategorySearchResultsInterfaceFactory;
use Aashan\HighlightedCategories\Api\HighlightedCategoryRepositoryInterface;
use Aashan\HighlightedCategories\Model\ResourceModel\HighlightedCategory as ResourceHighlightedCategory;
use Aashan\HighlightedCategories\Model\ResourceModel\HighlightedCategory\CollectionFactory as HighlightedCategoryCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class HighlightedCategoryRepository
 *
 * @package Aashan\HighlightedCategories\Model
 */
class HighlightedCategoryRepository implements HighlightedCategoryRepositoryInterface
{
    /**
     * @var ResourceHighlightedCategory
     */
    protected $resource;

    /**
     * @var HighlightedCategoryFactory
     */
    protected $highlightedCategoryFactory;

    /**
     * @var HighlightedCategoryCollectionFactory
     */
    protected $highlightedCategoryCollectionFactory;

    /**
     * @var HighlightedCategorySearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var HighlightedCategoryInterfaceFactory
     */
    protected $dataHighlightedCategoryFactory;

    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var ExtensibleDataObjectConverter
     */
    protected $extensibleDataObjectConverter;

    /**
     * @param ResourceHighlightedCategory $resource
     * @param HighlightedCategoryFactory $highlightedCategoryFactory
     * @param HighlightedCategoryInterfaceFactory $dataHighlightedCategoryFactory
     * @param HighlightedCategoryCollectionFactory $highlightedCategoryCollectionFactory
     * @param HighlightedCategorySearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceHighlightedCategory $resource,
        HighlightedCategoryFactory $highlightedCategoryFactory,
        HighlightedCategoryInterfaceFactory $dataHighlightedCategoryFactory,
        HighlightedCategoryCollectionFactory $highlightedCategoryCollectionFactory,
        HighlightedCategorySearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->highlightedCategoryFactory = $highlightedCategoryFactory;
        $this->highlightedCategoryCollectionFactory = $highlightedCategoryCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataHighlightedCategoryFactory = $dataHighlightedCategoryFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        HighlightedCategoryInterface $highlightedCategory
    ) {
        if (empty($highlightedCategory->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $highlightedCategory->setStoreId($storeId);
        }

        $highlightedCategoryData = $this->extensibleDataObjectConverter->toNestedArray(
            $highlightedCategory,
            [],
            HighlightedCategoryInterface::class
        );

        $highlightedCategoryModel = $this->highlightedCategoryFactory->create()->setData($highlightedCategoryData);

        try {
            $this->resource->save($highlightedCategoryModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the highlightedCategory: %1',
                $exception->getMessage()
            ));
        }
        return $highlightedCategoryModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($highlightedCategoryId)
    {
        $highlightedCategory = $this->highlightedCategoryFactory->create();
        $this->resource->load($highlightedCategory, $highlightedCategoryId);
        if (!$highlightedCategory->getId()) {
            throw new NoSuchEntityException(__('HighlightedCategory with id "%1" does not exist.', $highlightedCategoryId));
        }
        return $highlightedCategory->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        SearchCriteriaInterface $criteria
    ) {
        $collection = $this->highlightedCategoryCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            HighlightedCategoryInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        HighlightedCategoryInterface $highlightedCategory
    ) {
        try {
            $highlightedCategoryModel = $this->highlightedCategoryFactory->create();
            $this->resource->load($highlightedCategoryModel, $highlightedCategory->getHighlightedcategoryId());
            $this->resource->delete($highlightedCategoryModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the HighlightedCategory: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($highlightedCategoryId)
    {
        return $this->delete($this->get($highlightedCategoryId));
    }
}
