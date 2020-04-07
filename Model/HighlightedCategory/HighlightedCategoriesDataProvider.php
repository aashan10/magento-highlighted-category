<?php

namespace Aashan\HighlightedCategories\Model\HighlightedCategory;

use Aashan\HighlightedCategories\Model\ResourceModel\HighlightedCategory\CollectionFactory;
use Magento\Catalog\Model\ResourceModel\Category\Collection;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Framework\Api\Filter;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\DataObject;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class HighlightedCategoriesDataProvider extends AbstractDataProvider
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    protected $loadedData;
    /**
     * @var Collection
     */
    protected $categoryCollection;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        CategoryCollectionFactory $categoryCollectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collectionFactory = $collectionFactory;
        $this->collection = $this->collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        $this->categoryCollection = $categoryCollectionFactory->create();
        $this->categoryCollection->addAttributeToSelect('name');
        $this->categoryCollection->addAttributeToSelect('id');
        $this->categoryCollection->setStore($this->storeManager->getStore());
    }

    public function getData()
    {
//        $items = $this->collection->getItems();
//        $this->loadedData['totalRecords'] = count($items);
//        foreach ($items as $model) {
//            $this->loadedData['items'][$model->getId()] = [
//                'id' => $model->getId(),
//                'parent_category' => $model->getData('parent_category'),
//                'child_categories' => $model->getData('child_categories'),
//                'code' => $model->getData('code'),
//                'expires_on' => $model->getData('expires_on')
//            ];
//        }
        return $this->loadedData;
    }
    public function addFilter(Filter $filter)
    {
        return $this;
    }

    public function getCategoryDetails(DataObject $model)
    {
        $data = [];
        $data['parent_category'] = $this->categoryCollection->getItemById($model->getData('parent_category'))->getData();
        $data['child_categories'] = [];
        $childCategories = json_decode($model->getData('child_categories'));
        if (is_array($childCategories)) {
            foreach ($childCategories as $item) {
                $data['child_categories'][] = $this->categoryCollection->getItemById($item)->getData();
            }
        }
        $data['code'] = $model->getData('code');
        $data['expires_on'] = $model->getData('expires_on');
        $data['id'] = $model->getData('id');
        return $data;
    }
}
