<?php


namespace Belvg\Note\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_belvg_note_note = $setup->getConnection()->newTable($setup->getTable('belvg_note_note'));

        
        $table_belvg_note_note->addColumn(
            'note_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,),
            'Entity ID'
        );
        

        
        $table_belvg_note_note->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'customer_id'
        );
        

        
        $table_belvg_note_note->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'title'
        );
        

        
        $table_belvg_note_note->addColumn(
            'description',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'description'
        );
        

        $setup->getConnection()->createTable($table_belvg_note_note);

        $setup->endSetup();
    }
}
