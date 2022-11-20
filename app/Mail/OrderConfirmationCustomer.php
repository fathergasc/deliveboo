<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationCustomer extends Mailable
{
    use Queueable, SerializesModels;

    private $order;
    private $restaurant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $restaurant)
    {
        $this->order = $order;
        $this->restaurant = $restaurant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        $restaurant = $this->restaurant;

        return $this->view('emails.orderConfirmationCustomer', compact('order', 'restaurant'));
    }
}
