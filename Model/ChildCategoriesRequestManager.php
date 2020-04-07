<?php

/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Model;

use Aashan\HighlightedCategories\Api\ChildCategoriesRequestManagerInterface;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\ResourceModel\Category\Collection;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Framework\Webapi\Rest\Request;
use Magento\Framework\Webapi\Rest\Response;

class ChildCategoriesRequestManager implements ChildCategoriesRequestManagerInterface
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Response
     */
    private $response;
    /**
     * @var Collection
     */
    private $collection;

    public function __construct(CategoryCollectionFactory $factory, Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->collection = $factory->create()->addAttributeToSelect('name');
    }

    /**
     * Fetches subcategories of the supplied category.
     * @return Response
     */
    public function getData()
    {
        $categoryId = $this->request->getParam('id');
        if (!$categoryId) {
            $this->response->setStatusCode(400);
            $this->response->setContent(json_encode([
                'status' => 'error',
                'message' => __('Category ID Field is required')
            ]));
            return $this->response->send();
        }

        /** @var Category $category */
        $category = $this->collection->getItemById($categoryId);
        $children = $this->getChildCategories($category);
        $this->response->setContent(json_encode([
            'status' => 'success',
            'data' => [
                'parent_category' => [
                    'name' => $category->getData('name'),
                    'id' => $category->getId()
                ],
                'child_categories' => $children
            ]
        ]));
        return $this->response->send();
    }

    /**
     * List out subcategories recursively.
     * @param Category $category
     * @return array
     */
    private function getChildCategories(Category $category)
    {
        $categories = [];
        foreach ($category->getChildrenCategories() as $child) {
            /** @var $child Category */
            $categories[] = [
                'id' => $child->getId(),
                'name' => $child->getData('name')
            ];
            $categories = array_merge($categories, $this->getChildCategories($child));
        }
        return $categories;
    }
}
