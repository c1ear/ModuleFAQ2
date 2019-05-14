<?php
namespace Storenameaslkd\ModuleCrud\Model\Resource\Post;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection {
    protected function _construct() {
        $this->_init(
            'Storenameaslkd\ModuleCrud\Model\Post',
            'Storenameaslkd\ModuleCrud\Model\Resource\Post'
        );
    }
}
?>
