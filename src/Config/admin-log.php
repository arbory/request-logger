<?php

return [
    'sanitizer' => [
        'sensitive_string_identifiers' => [
            'XSRF-TOKEN',
            config('session.cookie')
        ],
        'sensitive_key_patterns' => [
            '(\S*)password(\S*).*',
            '(\S*)password(\S*)=*'
        ],
        'removed_value_notification' => 'value_removed_by_admin_log'
    ]
];