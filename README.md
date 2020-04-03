# Mage2 Module Aashan HighlightedCategories

    ``aashan/module-highlightedcategories``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
A Magento 2 Module for highlighted categories.

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Aashan`
 - Enable the module by running `php bin/magento module:enable Aashan_HighlightedCategories`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

## Configuration

 - Enable Highlighted Categories (general/configurations/enable_highlighted_categories)


## Specifications

 - Widget
	- highlightedCategory

 - Model
	- HighlightedCategory

 - Block
	- Widget\HighlightedCategory > widget/highlightedcategory.phtml

 - Controller
	- adminhtml > highlightedcategories/index/index

 - Controller
	- adminhtml > highlightedcategories/index/edit

 - Controller
	- adminhtml > highlightedcategories/index/update

 - Controller
	- adminhtml > highlightedcategories/index/delete

 - Controller
	- adminhtml > highlightedcategories/index/newAction

 - Controller
	- adminhtml > highlightedcategories/index/save



