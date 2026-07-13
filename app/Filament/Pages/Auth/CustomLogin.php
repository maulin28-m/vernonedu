<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Notifications\Notification;
use Illuminate\Validation\ValidationException;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;

class CustomLogin extends BaseLogin
{
    public function authenticate(): ?LoginResponse
    {
        try {
            return parent::authenticate();
        } catch (ValidationException $exception) {
            Notification::make()
                ->title('Login Gagal')
                ->body('Email atau password yang Anda masukkan salah.')
                ->danger()
                ->send();

            throw $exception;
        }
    }
}
