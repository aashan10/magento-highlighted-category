<?php

namespace Aashan\HighlightedCategories\Model\Rule;

use Aashan\HighlightedCategories\Model\ResourceModel\HighlightedCategory\Collection;
use Magento\Framework\Convert\DataObject;
use Magento\Framework\Data\OptionSourceInterface;

class HighlightsSelectProvider implements OptionSourceInterface
{
    /**
     * @var DataObject
     */
    private $dataObject;
    /**
     * @var Collection
     */
    private $collection;

    /**
     * HighlightsSelectProvider constructor.
     * @param DataObject $dataObject
     * @param Collection $collection
     */
    public function __construct(DataObject $dataObject, Collection $collection)
    {
        $this->dataObject = $dataObject;
        $this->collection = $collection;
        $this->collection->addFieldToSelect('code');
        $this->collection->addFieldToSelect('id');
    }

    public function toOptionArray()
    {
        return $this->dataObject->toOptionArray($this->collection->getItems(), 'id', 'code');
    }
}
