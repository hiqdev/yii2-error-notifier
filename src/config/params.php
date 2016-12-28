<?php

return [
    'errorNotifier' => [
        'email' => [
            'subject' => 'Error Log',
            'from' => $params['supportEmail'],
            'to' => $params['supportEmail'],
        ]
    ]
];
