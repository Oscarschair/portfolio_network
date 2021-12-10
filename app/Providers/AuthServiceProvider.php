<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('メールアドレス認証のお願い')
                ->line('Portfolio Networkをご利用いただき、誠にありがとうございます。')
                ->line('メールアドレスを認証することにより、本サービスをご利用いただけます。')
                ->line('以下のボタンをタップして、メールアドレスを認証してください。')
                ->action('メールアドレスを認証', $url);
        });
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = url(config('app.url') . route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
            return (new MailMessage)
                ->subject('パスワードリセット')
                ->line('パスワードリセット申請を受け付けました。')
                ->line('このパスワードリセットリンク60分後失効します。')
                ->action('パスワードリセット', $url);
        });
    }
}
