<?php

return [
    'default_admin' => [
        'first_name' => 'Super',
        'last_name' => 'Admin',
        'gender' => 'male',
        'type' => 'admin',
        'avatar' => 'admin.png',
        'phone' => '98 3030',
        'email' => 'amirhosein.sahra@gmail.com',
        'email_verified_at' => \Illuminate\Support\Carbon::now(),
        'password' => \Illuminate\Support\Facades\Hash::make('123456789'),
    ],
];
