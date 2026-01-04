<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MailServiceConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // যদি email_configs table থাকে
        if (\Schema::hasTable('email_configs')) {
            $mail = DB::table('email_configs')->first();

            if ($mail) {
                // Default mailer
                Config::set('mail.default', 'smtp');

                // SMTP mailer settings
                Config::set('mail.mailers.smtp', [
                    'transport' => 'smtp',
                    'host' => $mail->smtp_host,
                    'port' => $mail->smtp_port,
                    'encryption' => 'ssl', 
                    'username' => $mail->smtp_user,
                    'password' => $mail->smtp_pass,
                    'timeout' => null,
                    'auth_mode' => null,
                ]);

                // From address & name dynamic set
                Config::set('mail.from', [
                    'address' => $mail->from_address ?? env('MAIL_FROM_ADDRESS', 'hello@hello.com'),
                    'name' => $mail->from_name ?? env('MAIL_FROM_NAME', 'TestApp'),
                ]);
            }
        }
    }
}
