<?php

namespace Aashan\HighlightedCategories\Setup;

use Exception;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Psr\Log\LoggerInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function install(SchemaSetupInterface $installer, ModuleContextInterface $context)
    {
        $installer->startSetup();
        if (!$installer->tableExists('aashan_highlighted_categories')) {
            try {
                $table = $installer->getConnection()
                    ->newTable($installer->getTable('aashan_highlighted_categories'))
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'unsigned' => true,
                            'index' => true
                        ],
                        'Highlighted Category ID'
                    )
                    ->addColumn(
                        'code',
                        Table::TYPE_TEXT,
                        255,
                        [
                            'unique' => true,
                            'nullable' => false
                        ],
                        'Unique Code for Highlight'
                    )
                    ->addColumn(
                        'parent_category',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Parent Category ID'
                    )
                    ->addColumn(
                        'child_categories',
                        Table::TYPE_TEXT,
                        255,
                        [],
                        'Child Categories'
                    )
                    ->addColumn(
                        'cms_block',
                        Table::TYPE_TEXT,
                        255,
                        [],
                        'CMS Block ID'
                    )
                    ->addColumn(
                        'expires_on',
                        Table::TYPE_TIMESTAMP,
                        null,
                        [
                            'nullable' => true
                        ],
                        'Expires On'
                    )
                    ->setComment('Highlighted Categories Table');
                $installer->getConnection()->createTable($table);
            } catch (Exception $exception) {
                $this->logger->critical(
                    $exception->getFile()
                    . ' ' .
                    $exception->getLine()
                    . ' ==> ' .
                    $exception->getMessage()
                );
            }
            $installer->endSetup();
        }
    }
}
