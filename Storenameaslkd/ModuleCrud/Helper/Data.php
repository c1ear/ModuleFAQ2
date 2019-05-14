<?php
namespace Storenameaslkd\ModuleCrud\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;
class Data extends AbstractHelper {
    public function getModel($modelName){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $model = $objectManager->create('\Storenameaslkd\ModuleCrud\Model\\'.ucfirst($modelName));
        return $model;
    }

    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
?>