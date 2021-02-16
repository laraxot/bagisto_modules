<?php

namespace Modules\Admin\Listeners;

use Illuminate\Support\Facades\Mail;
use Modules\User\Notifications\AdminUpdatePassword;
use Modules\Customer\Notifications\CustomerUpdatePassword;

class PasswordChange
{
    /**
     * Send mail on updating password.
     *
     * @param  \Modules\Customer\Models\Customer|\Modules\User\Models\Admin  $adminOrCustomer
     * @return void
     */
    public function sendUpdatePasswordMail($adminOrCustomer)
    {
        try {
            if ($adminOrCustomer instanceof \Modules\Customer\Models\Customer) {
                Mail::queue(new CustomerUpdatePassword($adminOrCustomer));
            }

            if ($adminOrCustomer instanceof \Modules\User\Models\Admin) {
                Mail::queue(new AdminUpdatePassword($adminOrCustomer));
            }
        } catch (\Exception $e) {
            report($e);
        }
    }
}