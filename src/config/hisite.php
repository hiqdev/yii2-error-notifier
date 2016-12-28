<?php

return [
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
];
