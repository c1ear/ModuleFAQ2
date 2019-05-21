<?php

namespace Storenameaslkd\ModuleCrud\Controller\Index;

use \Magento\Framework\App\Action\Action;

class CustomAjax extends Action {

    public function execute()
    {
        $url = $this->_url->getUrl('crudmodule/index/index');//You can give any url, or current page url
        //Your ajax Request Code
        return $this->goBack($url);
    }
    protected function goBack($backUrl = null)
    {
        //if controller request is not ajax type
        if (!$this->getRequest()->isAjax()) {
            if ($backUrl || $backUrl = $redirectUrl) {
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setUrl($backUrl);
                return $resultRedirect;
            }
        }
        //if request is ajax type then it create result of json type and return the result
        $result = [];
        if ($backUrl || $backUrl = $redirectUrl) {
            $result['backUrl'] = $backUrl;
        }
        $this->getResponse()->representJson(
            $this->_objectManager->get('Magento\Framework\Json\Helper\Data')
                ->jsonEncode($result)
        );
    }
}