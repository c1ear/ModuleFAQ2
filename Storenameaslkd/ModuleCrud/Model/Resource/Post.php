<?php
namespace Storenameaslkd\ModuleCrud\Model\Resource;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Post extends AbstractDb {
    protected function _construct() {
        $this->_init('post', 'post_id');
    }
}
?>