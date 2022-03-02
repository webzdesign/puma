<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailOtp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->otp = $data['otp'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = config('app.name');
        return $this->view('email.otp')
            ->from('info@angelspearlinfotech.com', $company)
            ->subject('Hello ' . $this->name . ' , Your Login Otp Is.')
            ->with([
                'company' => $company,
                'name' => $this->name,
                'email' => $this->email,
                'otp' => $this->otp,
            ]);
    }
}
