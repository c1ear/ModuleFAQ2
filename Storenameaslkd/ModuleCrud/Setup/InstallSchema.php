<?php
namespace Storenameaslkd\ModuleCrud\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $installer = $setup;
        $installer->startSetup();
        $tableName = $installer->getTable('post');
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            $table = $installer->getConnection()
                ->newTable($tableName)


                ->addColumn('post_id', Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ], ' Post ID')

                ->addColumn('tags', Table::TYPE_TEXT, null, [
                    'length' => '64k',
                    'nullable' => false
                ], 'Post Title')


                ->addColumn('post_content', Table::TYPE_TEXT, null, [
                    'length' => '64k',
                    'nullable' => false
                ], 'Post Post Content')


                ->addColumn('name', Table::TYPE_TEXT, null, [
                    'length' => 255,
                    'nullable' => false
                ], 'Post Name')


                ->addColumn('is_active', Table::TYPE_INTEGER, null, [
                    'length' => 1,
                    'nullable' => false
                ], 'Post Status')



                ->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [
                    'length' => 255,
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ], 'Created At')


                ->setComment('Post Table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('post'),
                $setup->getIdxName(
                    $installer->getTable('post'),
                    ['tags','post_content','name','is_active'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['tags','post_content','name','is_active'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            );

        }
        $installer->endSetup();
    }
}
?>