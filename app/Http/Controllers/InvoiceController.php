<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::with('items')->find(5);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('invoicePdf',['invoice' => $invoice]));
        return $pdf->stream();

    }
}
