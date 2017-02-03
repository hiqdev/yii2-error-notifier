<?php
/**
 * Error Notifier for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-error-notifier
 * @package   yii2-error-notifier
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016-2017, HiQDev (http://hiqdev.com/)
 */

return [
    'adminEmail' => null,
    'errorNotifier' => [
        'log.subject' => 'Error Log',
        'feedback.subject' => 'Error feedback',
        'flagDomainName' => true,
        'email' => [
            'from' => null,
            'to' => null,
        ],
    ],
];
