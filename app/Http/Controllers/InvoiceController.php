<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Preview invoice as HTML
     */
    public function preview(Payment $payment)
    {
        $this->authorizeUser($payment);
        
        if (!$payment->hasInvoice()) {
            return redirect()->back()->with('error', 'Invoice not available for this payment.');
        }

        $payment->load(['order.user', 'order.orderItems.product']);

        return view('invoices.invoice', [
            'payment' => $payment,
            'order' => $payment->order,
            'isPreview' => true,
        ]);
    }

    /**
     * Download invoice as PDF
     */
    public function download(Payment $payment)
    {
        $this->authorizeUser($payment);

        if (!$payment->hasInvoice()) {
            return redirect()->back()->with('error', 'Invoice not available for this payment.');
        }

        $payment->load(['order.user', 'order.orderItems.product']);

        $pdf = Pdf::loadView('invoices.invoice', [
            'payment' => $payment,
            'order' => $payment->order,
            'isPreview' => false,
        ]);

        $filename = 'invoice-' . ($payment->invoice_number ?? $payment->id) . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Generate PDF for email attachment
     */
    public static function generatePdf(Payment $payment): string
    {
        $payment->load(['order.user', 'order.orderItems.product']);

        $pdf = Pdf::loadView('invoices.invoice', [
            'payment' => $payment,
            'order' => $payment->order,
            'isPreview' => false,
        ]);

        return $pdf->output();
    }

    /**
     * Authorize user access to invoice
     */
    protected function authorizeUser(Payment $payment): void
    {
        $user = auth()->user();
        
        // Admin can view all invoices
        if ($user->is_admin) {
            return;
        }

        // User can only view their own invoices
        if ($payment->order->user_id !== $user->id) {
            abort(403, 'Unauthorized access to invoice.');
        }
    }
}
