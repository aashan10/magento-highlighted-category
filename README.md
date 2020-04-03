# Highlighted Categories

 - [Main Functionality](#main-functionality)
 - [Installation](#installation)
    - [Clone and Install](#clone-and-install)
    - [Zip file Installation](#zip-file-installation)
    - [Post Installation](#post-installation)
 - [Configuration](#configuration)
 - [Contributing](#contributing)


## Main Functionality 
A Magento 2 Module for highlighted categories.
You can use this module for creating highlights of categories in
your Magento 2 pages. This module is under active development. So,
contributions are very much welcomed. 

## Installation

### Clone and Install
- Create a `Aashan` directory under `app/code` directory of your Magento 2 installation.
- Clone the repository into `app/code/Aashan/HighlightedCategories` directory. 
Use the `production` branch.

### Zip file installation

 - Unzip the zip file in `app/code/Aashan` and rename the directory 
 `magento-highlighted-categories` into `HighlightedCategories`
 
 ### Post Installation
 - Enable the module by running `php bin/magento module:enable Aashan_HighlightedCategories`
 - Apply database updates by running `php bin/magento setup:upgrade`
 - Flush the cache by running `php bin/magento cache:flush`

## Configuration

 - Enable Highlighted Categories in `Store > Configurations > Highlighted Categories > General`

## Contributing
- Fork this repository and send pull requests clearly mentioning the objective of the PR.
