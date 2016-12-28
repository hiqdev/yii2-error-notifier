<?php

return array_filter([
    'components' => [
        'log' => [
            'targets' => [
                'email-error-notifications' => [
                    'class' => \hipanel\log\EmailTarget::class,
                    'levels' => ['error'],
                    'message' => [
                        'from' => isset($params['errorNotifier']['email']['from'])
                            ? $params['errorNotifier']['email']['from']
                            : $params['supportEmail'],
                        'to' => isset($params['errorNotifier']['email']['to'])
                            ? $params['errorNotifier']['email']['to']
                            : $params['supportEmail'],
                        'subject' => isset($params['errorNotifier']['email']['subject'])
                            ? $params['errorNotifier']['email']['subject']
                            : null,
                    ],
                ],
            ],
        ],
    ],
    'bootstrap' => defined('YII_DEBUG') && YII_DEBUG && empty($params['errorNotifier']['email']['from']) ? [
        'yii2-error-notifier-warning' => function () {
            Yii::warning('Error notifier not configured');
        }
    ] : null,
]);
