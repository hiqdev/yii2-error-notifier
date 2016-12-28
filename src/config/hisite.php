<?php

return [
    'components' => [
        'log' => [
            'targets' => [
                'email-error-notifications' => [
                    'class' => \hipanel\log\EmailTarget::class,
                    'levels' => ['error'],
                    'message' => [
                        'from' => $params['errorNotifier']['email']['from'],
                        'to' => $params['errorNotifier']['email']['to'],
                        'subject' => $params['errorNotifier']['email']['subject'],
                    ],
                ],
            ],
        ],
    ],
];
