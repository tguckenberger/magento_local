<?php

namespace InteractOne\LimitStates\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        try {
            $table = $setup->getConnection()->newTable(
                $setup->getTable('interactone_states')
            )->addColumn(
                'state_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                255,
                ['identity' => true, 'auto_increment' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'State ID'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'State name'
            )->addColumn(
                'state_allowed',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                null,
                [],
                'State allowed'
            )->setComment(
                'Allowed States Table'
            );
        } catch (\Zend_Db_Exception $e) {
        }
        $setup->endSetup();
    }
}