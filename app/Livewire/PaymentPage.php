<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class PaymentPage extends Component
{
    public string $ticketNumber = '';
    public ?Order $order = null;
    public string $paymentMethod = 'cash';
    public string $message = '';

    public function findOrder()
    {
        $this->order = Order::where('ticket_number', $this->ticketNumber)
            ->where('status', 'open')
            ->with('items.product')
            ->first();

        if (!$this->order) {
            $this->message = 'No open order found with that ticket number.';
        } else {
            $this->message = '';
        }
    }

    public function processPayment()
    {
        if (!$this->order) {
            return;
        }

        $this->order->update([
            'status' => 'paid',
        ]);

        $this->message = "Payment recorded for ticket {$this->order->ticket_number}.";
        $this->order = null;
        $this->ticketNumber = '';
    }

    public function render()
    {
        return view('livewire.payment-page')->layout('layouts.app');
    }
}