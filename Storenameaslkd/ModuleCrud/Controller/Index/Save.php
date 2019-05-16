<?php
namespace Storenameaslkd\ModuleCrud\Controller\Index;

use Magento\Contact\Model\MailInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\DataObject;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_postFactory;
    protected $_filesystem;
    protected $mail;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Storenameaslkd\ModuleCrud\Model\PostFactory $postFactory,
        \Magento\Framework\Filesystem $filesystem,
        MailInterface $mail
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        $this->_filesystem = $filesystem;
        $this->mail = $mail;
        return parent::__construct($context);
    }

    public function execute()
    {
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

            $this->sendEmail($this->validatedParams());


    }

    private function sendEmail($data)
    {
        $this->mail->send($data['email'], ['data' => new \Magento\Framework\DataObject($data)]);
        $this->mail->send(
            $data['email'],
            ['data' => new DataObject($data)]
        );

    }
    private function validatedParams()
    {
        $request = $this->getRequest();

        return $request->getParams();
    }

    public function send($replyTo, array $variables)
    {
        /** @see \Magento\Contact\Controller\Index\Post::validatedParams() */
        $replyToName = !empty($variables['data']['name']) ? $variables['data']['name'] : null;

        $this->inlineTranslation->suspend();
        try {
            $transport = $this->transportBuilder
                ->setTemplateIdentifier($this->contactsConfig->emailTemplate())
                ->setTemplateOptions(
                    [
                        'area' => Area::AREA_FRONTEND,
                        'store' => $this->storeManager->getStore()->getId()
                    ]
                )
                ->setTemplateVars($variables)
                ->setFrom($this->contactsConfig->emailSender())
                ->addTo($this->contactsConfig->emailRecipient())
                ->setReplyTo($replyTo, $replyToName)
                ->getTransport();

            $transport->sendMessage();
        } finally {
            $this->inlineTranslation->resume();
        }
    }

}
?>