<?php

    use Illuminate\Support\Facades\Lang;

    return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'reset'     => 'Ваш пароль был сброшен!',
    'sent'      => 'Ссылка на сброс пароля была отправлена!',
    'throttled' => 'Пожалуйста, подождите перед повторной попыткой.',
    'token'     => 'Ошибочный код сброса пароля.',
    'user'      => 'Не удалось найти пользователя с указанным электронным адресом.',
    'Reset Password Notification' => 'Уведомление о сбросе пароля',
    //->subject(Lang::get('Уведомление о сбросе пароля'))
    //->line(Lang::get('Вы получили это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи.'))
    //->action(Lang::get('Сбросить пароль'), $url)
    //->line(Lang::get('Срок действия этой ссылки для сброса пароля истекает через :count минут.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
    //->line(Lang::get('Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется.'));


     //->subject(Lang::get('Reset Password Notification'))
    //->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
//    ->action(Lang::get('Reset Password'), $url)
//    ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
//    ->line(Lang::get('If you did not request a password reset, no further action is required.'));

];
