<?php
namespace App\Mailers;

use App\Order;
use Illuminate\Contracts\Mail\Mailer;

class InvoiceMailer {
    protected $mailer; 
    protected $fromAddress = 'arpitha@telcopl.com';
    protected $fromName = 'Invoice details';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendInvoiceInformation($user, Order $order)
    {
        $this->to = $user->email;
        $this->subject = "[Invoice ID: $order->order_id]";
        $this->view = 'emails.invoice_info';
        $this->data = compact('user', 'order');

        return $this->deliver();
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message) {
            $message->from($this->fromAddress, $this->fromName)
                    ->to($this->to)->subject($this->subject);
        });
    }
    
    
}