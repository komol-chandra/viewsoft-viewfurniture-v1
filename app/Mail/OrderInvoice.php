<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderInvoice extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    protected $division;
    protected $district;

    public function __construct($data, $division, $district)
    {
        $this->data = $data;
        $this->division = $division;
        $this->district = $district;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $division = $this->division;
        $district = $this->district;
        return $this->subject('Order Placed')->view('frontend.mailsend.orderinvoice', compact('data', 'division', 'district'));
    }
}
