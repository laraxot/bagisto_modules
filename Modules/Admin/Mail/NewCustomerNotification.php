<?php

namespace Modules\Admin\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewCustomerNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The customer instance.
     *
     * @var  \Modules\Customer\Contracts\Customer
     */
    public $customer;

    /**
     * The password instance.
     *
     * @var string
     */
    public $password;

    /**
     * Create a new message instance.
     * 
     * @param  \Modules\Customer\Contracts\Customer  $order
     * @param  string  $password
     * @return void
     */
    public function __construct(
        $customer,
        $password
    )
    {
        $this->customer = $customer;

        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
                    ->to($this->customer->email)
                    ->subject(trans('shop::app.mail.customer.new.subject'))
                    ->view('shop::emails.customer.new-customer')->with(['customer' => $this->customer, 'password' => $this->password]);
    }
}