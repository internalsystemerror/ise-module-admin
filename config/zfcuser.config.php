<?php

namespace Ise\Admin;

use Ise\Admin\Entity\User;

return [
    'enable_default_entities'           => false,
    'user_entity_class'                 => User::class,
    'enable_registration'               => true,
    'enable_username'                   => true,
    'enable_display_name'               => true,
    'auth_identity_fields'              => ['email', 'username'],
    'login_after_registration'          => false,
    'use_redirect_parameter_if_present' => true,
    'login_redirect_route'              => 'admin',
    'logout_redirect_route'             => 'zfcuser/login',
    'table_name'                        => 'admin_user',
];
