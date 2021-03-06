<?php
namespace Storenameaslkd\ModuleCrud\Controller\Index;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\DataObject;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_postFactory;
    protected $_filesystem;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Storenameaslkd\ModuleCrud\Model\PostFactory $postFactory,
        \Magento\Framework\Filesystem $filesystem
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        $this->_filesystem = $filesystem;
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->_eventManager->dispatch('mail_send_test');

        if ($this->getRequest()->isPost()) {
            $input = $this->getRequest()->getPostValue();
            $post = $this->_postFactory->create();
            if($input['editRecordId']){
                $post->load($input['editRecordId']);
                $post->addData($input);
                $post->setId($input['editRecordId']);
                $post->save();
            }else{
                $post->setData($input)->save();
            }


            return $this->_redirect('crudmodule/index/index');
        }
    }
}
?>