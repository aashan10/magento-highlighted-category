<?php
/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Controller\Adminhtml\Index;

use Aashan\HighlightedCategories\Model\ResourceModel\HighlightedCategory\CollectionFactory;
use DateTime;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Save extends Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var CollectionFactory
     */
    private $factory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param CollectionFactory $factory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CollectionFactory $factory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
        $this->factory = $factory;
    }

    /**
     * Saves Highlighted Category and redirects back.
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $this->validateRequest();
        $request = $this->getRequest()->getParams();
        $collection = $this->factory->create();
        if (isset($request['id']) && !empty($request['id'])) {
            $highlightedCategory = $collection->load($request['id']);
        } else {
            $highlightedCategory = $collection->getNewEmptyItem();
        }
        $highlightedCategory->setData('code', $request['code']);
        $highlightedCategory->setData('parent_category', $request['parent_category']);
        $highlightedCategory->setData('child_categories', json_encode($request['child_categories']));
        $highlightedCategory->setData('cms_block', $request['cms_block']);
        $highlightedCategory->setData('expires_on', DateTime::createFromFormat('Y-m-d', time()));
        $highlightedCategory->save();
        $this->messageManager->addSuccessMessage(__('Highlight has been saved successfully!'));
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }

    /**
     * @return Redirect|string
     */
    public function validateRequest()
    {
        $request = $this->getRequest();
        if ($request->getParam('code') === null) {
            $this->messageManager->addErrorMessage(__('The `Code` field is required!'));
        }
        if ($request->getParam('parent_category') === null) {
            $this->messageManager->addErrorMessage(__('The `Parent Category` field is required!'));
        }
        if ($request->getParam('child_categories') === null) {
            $this->messageManager->addErrorMessage(__('The `Child Categories` field is required!'));
        }
        if ($request->getParam('cms_block') === null) {
            $this->messageManager->addErrorMessage(__('The `CMS Block` field is required!'));
        }
        if (
            !$request->getParam('code') ||
            !$request->getParam('child_categories') ||
            !$request->getParam('parent_category') ||
            !$request->getParam('cms_block')
        ) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        return '';
    }
}
