<?php
namespace Storenameaslkd\ModuleCrud\Model\ResourceModel\Grid;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'post_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Storenameaslkd\ModuleCrud\Model\Grid',
            'Storenameaslkd\ModuleCrud\Model\ResourceModel\Grid'
        );
    }
}