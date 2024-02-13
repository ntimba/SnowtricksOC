<?php

namespace App\Enumeration;

enum TokenType: string
{
    case RegistrationToken = 'registration_token';
    case passwordRecoveryToken = 'password_recovery_token';
}
