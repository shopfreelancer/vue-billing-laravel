<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\User;

class InvoiceController extends Controller
{
    public function index()
    {
        $user = User::with('address')->find(1);

        $invoice = Invoice::with('items')->find(5);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('invoicePdf',['invoice' => $invoice, 'user' => $user]));

        return $pdf->stream();

    }
}
