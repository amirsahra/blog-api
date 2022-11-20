<?php

return [
    'index_method' => 'show all :name.',
    'store_method' => ':name create successfully.',
    'show_method' => 'show :name',
    'update_method' => 'update :name successfully.',
    'destroy_method' => 'delete :name successfully.',
    'validate_failed' => 'The given data was invalid.',
    'unauthorized' => 'Unauthorized - You don’t have permission to access this item.',
    'forbidden' => 'Forbidden – You don’t have permission to access.',
    'auth' => [
        'logout' => 'You have been successfully logged out!',
        'login' => [
            'success' => 'You are successfully logged in.',
            'failed' => 'Incorrect email or password.',
        ],
        'register' => 'You are successfully register. Email confirmation link has been sent to your email, please confirm your email.',
        'email_verify' => [
            'already' => 'Your email has already been verified.',
            'Invalid' => 'Invalid/Expired url provided.',
            'success' => 'Success verify email.',
            'resend' => 'Verification link sent!',
            'subject' => 'Verify Email Address'
        ],
    ],
];
