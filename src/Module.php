<?php
/**
 * Error Notifier for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-error-notifier
 * @package   yii2-error-notifier
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\errorNotifier;

use Yii;

class Module extends \yii\base\Module
{
    public $flagWithDomain;

    public function flagEmail($email)
    {
        if (empty($this->flagWithDomain)) {
            return $email;
        }

        list($nick, $host) = explode('@', $email, 2);

        return $nick . '+' . Yii::$app->request->getHostName() . '@' . $host;
    }

    public function flagText($text, $delimiter = ' ')
    {
        if (empty($this->flagWithDomain)) {
            return $text;
        }

        return '[' . Yii::$app->request->getHostName() . ']' . $delimiter . $text;
    }

    public static function getInstance()
    {
        return Yii::$app->getModule('error-notifier');
    }
}
