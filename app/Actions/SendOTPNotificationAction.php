<?php

namespace App\Actions;

use App\Models\User;
use App\Notifications\EmailOTPNotification;

class SendOTPNotificationAction
{


    public function execute(User $user):void
    {
        $code = rand(100000, 999999);

        $user->update(["code" => $code]);

        $user->notify(new EmailOTPNotification($code));
    }

}
