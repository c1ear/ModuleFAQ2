<?php
namespace Storenameaslkd\ModuleCrud\Model;
use Storenameaslkd\ModuleCrud\Api\Data\GridInterface;
class Grid extends \Magento\Framework\Model\AbstractModel implements GridInterface
{

    const CACHE_TAG = 'post';
    protected $_cacheTag = 'post';
    protected $_eventPrefix = 'post';
    protected function _construct()
    {
        $this->_init('Storenameaslkd\ModuleCrud\Model\ResourceModel\Grid');
    }

    public function getPostId() { return $this->getData(self::POST_ID); }
    public function setPostId($postId) { return $this->setData(self::POST_ID, $postId);}


    public function getTags() { return $this->getData(self::TAGS); }
    public function setTags($tags) { return $this->setData(self::TAGS, $tags); }


    public function getPostContent() { return $this->getData(self::POST_CONTENT); }
    public function setPostContent($postContent) { return $this->setData(self::POST_CONTENT, $postContent); }


    public function getName() { return $this->getData(self::NAME); }
    public function setName($name) { return $this->setData(self::NAME, $name); }


    public function getStatus() { return $this->getData(self::STATUS); }
    public function setStatus($status) { return $this->setData(self::STATUS, $status); }


    public function getCreatedAt() { return $this->getData(self::CREATED_AT); }
    public function setCreatedAt($createdAt) { return $this->setData(self::CREATED_AT, $createdAt); }
}