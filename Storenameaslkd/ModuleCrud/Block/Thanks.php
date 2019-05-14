<?php
namespace Storenameaslkd\ModuleCrud\Block;
use Magento\Framework\Model\Entity\ScopeInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Storenameaslkd\ModuleCrud\Helper\Data;
use Storenameaslkd\ModuleCrud\Model\Post;
use Storenameaslkd\ModuleCrud\Model\PostFactory;


class Thanks extends Template
{

    /**
     * @var Data
     */
    private $helper;
    /**
     * @var PostFactory
     */
    private $postFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PostFactory $postFactory
     * @param Data $helper
     */
    public function __construct(
        Context $context,
        PostFactory $postFactory,
        Data $helper


    )
    {
        parent::__construct($context);


        $this->helper = $helper;
        $this->postFactory = $postFactory;
    }

    public function getResult()
    {
        $post = $this->postFactory->create();
        $collection = $post->getCollection();
        return $collection;
    }

    protected function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set($this->helper->getConfig('helloworld/general/display_h1'));
        $this->pageConfig->setDescription($this->helper->getConfig('helloworld/general/display_desc'));
        $this->pageConfig->setKeywords($this->helper->getConfig('helloworld/general/display_keywords'));
    }

}
?>