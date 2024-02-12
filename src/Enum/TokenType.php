<?php

namespace App\Enum;

enum TokenType: string
{
    case RegistrationToken = 'registration_token';
    case passwordRecoveryToken = 'password_recovery_token';
}