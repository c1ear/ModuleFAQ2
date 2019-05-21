<?php /** @noinspection ALL */

namespace Storenameaslkd\ModuleCrud\Observer;

use Magento\Contact\Model\MailInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;


class Email implements ObserverInterface
{
    protected $mail;
    /**
     * @param Observer $observer
     * @return void
     */
    public function __construct(
        MailInterface $mail
    )
    {
        $this->mail = $mail;
    }

    public function execute(Observer $observer)
    {
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