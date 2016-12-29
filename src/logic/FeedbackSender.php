<?php
/**
 * Error Notifier for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-error-notifier
 * @package   yii2-error-notifier
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\errorNotifier\logic;

use hiqdev\yii2\errorNotifier\models\FeedbackForm;
use yii\base\InvalidConfigException;
use yii\base\Object;
use yii\mail\MailerInterface;

/**
 * Class FeedbackSender provides API to send send user feedback to the system administrators.
 */
class FeedbackSender extends Object
{
    /**
     * @var FeedbackForm
     */
    private $feedbackForm;
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var string
     */
    public $from;
    /**
     * @var string
     */
    public $to;
    /**
     * @var string
     */
    public $subject;
    /**
     * @var string
     */
    public $view;

    /**
     * FeedbackSender constructor.
     * @param FeedbackForm $feedbackForm
     * @param MailerInterface $mailer
     * @param array $options
     */
    public function __construct($feedbackForm, MailerInterface $mailer, $options = [])
    {
        parent::__construct($options);

        $this->feedbackForm = $feedbackForm;
        $this->mailer = $mailer;

        $this->checkOptions();
    }

    /**
     * @throws InvalidConfigException when one of required configuration fields is not filled properly
     */
    private function checkOptions()
    {
        foreach (['from', 'to', 'subject', 'view'] as $option) {
            if (!isset($this->{$option})) {
                throw new InvalidConfigException("Property \"$option\" property must be set");
            }
        }
    }

    /**
     * @return bool whether email was sent successfully
     */
    public function send()
    {
        return $this->mailer
            ->compose($this->view, ['form' => $this->feedbackForm])
            ->setFrom($this->from)
            ->setTo($this->to)
            ->setSubject($this->subject)
            ->send();
    }
}
