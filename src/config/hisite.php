<?php

return array_filter([
    'components' => [
        'i18n' => [
            'translations' => [
                'error-notifier' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@hiqdev/yii2/errorNotifier/messages',
                    'sourceLanguage' => 'en-US',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'error-notifier/error/index',
        ],
        'log' => [
            'targets' => [
                'email-error-notifications' => [
                    'class' => \hipanel\log\EmailTarget::class,
                    'levels' => ['error'],
                    'message' => [
                        'from' => isset($params['errorNotifier']['email']['from'])
                            ? $params['errorNotifier']['email']['from']
                            : $params['adminEmail'],
                        'to' => isset($params['errorNotifier']['email']['to'])
                            ? $params['errorNotifier']['email']['to']
                            : $params['adminEmail'],
                        'subject' => isset($params['errorNotifier']['log.subject'])
                            ? $params['errorNotifier']['feedback.subject']
                            : null,
                    ],
                ],
            ],
        ],
    ],
    'bootstrap' => defined('YII_DEBUG') && YII_DEBUG && empty($params['errorNotifier']['email']['from']) ? [
        'yii2-error-notifier-warning' => function () {
            Yii::warning('Error notifier is not configured');
        }
    ] : null,
    'modules' => [
        'error-notifier' => [
            'class' => \hiqdev\yii2\errorNotifier\Module::class,
        ],
    ],
    'container' => [
        'definitions' => [
            \hiqdev\yii2\errorNotifier\logic\FeedbackSender::class => [
                'class' => \hiqdev\yii2\errorNotifier\logic\FeedbackSender::class,
                'from' => isset($params['errorNotifier']['email']['from'])
                    ? $params['errorNotifier']['email']['from']
                    : $params['adminEmail'],
                'to' => isset($params['errorNotifier']['email']['to'])
                    ? $params['errorNotifier']['email']['to']
                    : $params['adminEmail'],
                'subject' => $params['errorNotifier']['feedback.subject'],
                'view' => '@hiqdev/yii2/errorNotifier/views/email/feedback.php',
            ],
        ],
    ],
]);
