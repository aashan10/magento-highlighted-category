<?php

/**
 * This file is a part of HighlightedCategories Magento 2 module.
 *
 * @module HighlightedCategories
 * @author Ashan Ghimire <ashanghimire10@gmail.com>
 * @copyright Ashan Ghimire, 2020
 */

namespace Aashan\HighlightedCategories\Controller\Adminhtml\Index;

use Aashan\HighlightedCategories\Model\HighlightedCategory;
use Aashan\HighlightedCategories\Model\ResourceModel\HighlightedCategory as HCResourceModel;
use Aashan\HighlightedCategories\Model\ResourceModel\HighlightedCategory\Collection;
use Exception;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Action
{
    /**
     * @var Collection
     */
    private $highlightCollection;
    /**
     * @var HCResourceModel
     */
    private $resourceModel;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Collection $highlightCollection
     * @param HCResourceModel $resourceModel
     */
    public function __construct(
        Context $context,
        Collection $highlightCollection,
        HCResourceModel $resourceModel
    ) {
        parent::__construct($context);
        $this->highlightCollection = $highlightCollection;
        $this->resourceModel = $resourceModel;
    }

    /**
     * Delete the Highlighted category and redirect back.
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $highlightId = (string) $this->getRequest()->getParam('id');
        if (!$highlightId) {
            $this->messageManager->addErrorMessage(__('The highlight was not found!'));
        } else {
            /** @var HighlightedCategory $highlight */
            $highlight = $this->highlightCollection->getItemById($highlightId);
            if ($highlight->getData('id') == null) {
                $this->messageManager->addErrorMessage(__('The highlight doesn\'t exist!'));
            } else {
                try {
                    $this->resourceModel->delete($highlight);
                    $this->messageManager->addSuccessMessage(__('The highlight has been deleted successfully!'));
                } catch (Exception $e) {
                    $this->messageManager->addErrorMessage(__('The highlight couldn\'t be deleted!'));
                }
            }
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
