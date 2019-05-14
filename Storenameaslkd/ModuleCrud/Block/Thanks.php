<?php
namespace Storenameaslkd\ModuleCrud\Block;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Storenameaslkd\ModuleCrud\Helper\Data;
use Storenameaslkd\ModuleCrud\Model\Post;


class Thanks extends Template {

    protected $_filesystem;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Storenameaslkd\ModuleCrud\Model\PostFactory $postFactory
    )
    {
        parent::__construct($context);
        $this->_postFactory = $postFactory;
    }

    public function getResult()
    {
        $post = $this->_postFactory->create();
        $collection = $post->getCollection();
        return $collection;
    }
}
?>