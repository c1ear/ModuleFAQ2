<?php
namespace Storenameaslkd\ModuleCrud\Model;
use Magento\Framework\Model\AbstractModel;
class Post extends AbstractModel {
    protected function _construct() {
        $this->_init('Storenameaslkd\ModuleCrud\Model\Resource\Post');
    }
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
?>