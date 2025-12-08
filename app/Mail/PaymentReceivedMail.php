<?php

namespace App\Mail;

use App\Http\Controllers\InvoiceController;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentReceivedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Payment $payment)
    {
        $this->payment->load(['order.user', 'order.orderItems.product']);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Received - Invoice #' . ($this->payment->invoice_number ?? $this->payment->id),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payments.payment-received',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $filename = 'invoice-' . ($this->payment->invoice_number ?? $this->payment->id) . '.pdf';
        
        return [
            Attachment::fromData(
                fn () => InvoiceController::generatePdf($this->payment),
                $filename
            )->withMime('application/pdf'),
        ];
    }
}
