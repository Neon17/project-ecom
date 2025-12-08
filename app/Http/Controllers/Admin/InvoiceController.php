<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of all invoices (completed payments)
     */
    public function index(Request $request)
    {
        $query = Payment::query()
            ->with(['order.user'])
            ->where('status', PaymentStatusEnum::Completed)
            ->whereNotNull('paid_at');

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_number', 'like', '%' . $request->search . '%')
                  ->orWhere('transaction_code', 'like', '%' . $request->search . '%')
                  ->orWhereHas('order.user', function ($u) use ($request) {
                      $u->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $invoices = $query->latest('paid_at')->paginate(10);
        
        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Display the specified invoice
     */
    public function show(Payment $payment)
    {
        if (!$payment->hasInvoice()) {
            return redirect()->route('admin.invoices.index')
                ->with('error', 'Invoice not available for this payment.');
        }

        $payment->load(['order.user', 'order.orderItems.product']);

        return view('invoices.invoice', [
            'payment' => $payment,
            'order' => $payment->order,
            'isPreview' => true,
        ]);
    }

    /**
     * Download invoice PDF
     */
    public function download(Payment $payment)
    {
        if (!$payment->hasInvoice()) {
            return redirect()->route('admin.invoices.index')
                ->with('error', 'Invoice not available for this payment.');
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
}
