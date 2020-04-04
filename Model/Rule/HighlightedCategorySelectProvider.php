<?php

namespace Aashan\HighlightedCategories\Model\Rule;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Category\Collection as CategoryCollection;
use Magento\Framework\Convert\DataObject;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Store\Model\StoreManagerInterface;

class HighlightedCategorySelectProvider implements OptionSourceInterface
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var CategoryCollection
     */
    private $collection;
    /**
     * @var DataObject
     */
    private $dataObject;

    public function __construct(
        StoreManagerInterface $storeManager,
        CategoryCollectionFactory $collectionFactory,
        DataObject $dataObject
    ) {

        $this->storeManager = $storeManager;
        $this->collection = $collectionFactory
                            ->create()
                            ->setStore($storeManager->getStore())
                            ->addAttributeToSelect('name')
                            ->addAttributeToSelect('id')
                            ->addFieldToFilter('children_count', ['gt' => 0]);
        $this->dataObject = $dataObject;
    }

    public function toOptionArray()
    {
        return $this->dataObject->toOptionArray($this->collection->getItems(), 'id', 'name');
    }
}
