<?php


namespace Aashan\HighlightedCategories\Block\Adminhtml;


use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;

class UpdateCategories extends Template
{
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    public function __construct(Template\Context $context, UrlInterface $urlBuilder, array $data = [])
    {
        parent::__construct($context, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->urlBuilder->getBaseUrl() . '/rest/V1/aashan-highlightedcategories/subcategories/';
    }
}
