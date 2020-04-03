<?php
/**
 * A Magento 2 Module for highlighted categories.
 * Copyright (C) 2020  Ashan Ghimire
 *
 * This file is part of Aashan/HighlightedCategories.
 *
 * Aashan/HighlightedCategories is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Aashan\HighlightedCategories\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Delete
 *
 * @package Aashan\HighlightedCategories\Controller\Adminhtml\Index
 */
class Delete extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param Context  $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Delete the Highlighted category and redirect back.
     *
     * @return ResultInterface
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}

