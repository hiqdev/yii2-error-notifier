<?php
/**
 * Error Notifier for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-error-notifier
 * @package   yii2-error-notifier
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\errorNotifier\targets;

use Yii;

class EmailTarget extends \yii\log\EmailTarget
{
    /**
     * Sends log messages to specified email addresses.
     */
    public function export()
    {
        // moved initialization of subject here because of the following issue
        // https://github.com/yiisoft/yii2/issues/1446
        if (empty($this->message['subject'])) {
            $this->message['subject'] = 'Application Log';
        }
        $messages = array_map([$this, 'formatMessage'], $this->messages);
        $body = $this->getDebugLogLink();
        $body .= implode("\n", $messages);
        $this->composeMessage($body)->send($this->mailer);
    }

    private function getDebugLogLink()
    {
        if (!Yii::$app->hasModule('debug')) {
            return '';
        }

        $url = Yii::$app->getUrlManager()->createAbsoluteUrl([
            '/debug/default/view',
            'panel' => 'log',
            'tag' => Yii::$app->getModule('debug')->logTarget->tag,
        ]);

        return "See debug log: $url\n\n";
    }
}