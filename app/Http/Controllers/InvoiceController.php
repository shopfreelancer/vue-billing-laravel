<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\User;

class InvoiceController extends Controller
{
    public function generatePdf($id)
    {
        $user = User::with('address')->find(1);
        $invoice = Invoice::with('items')->find($id);

        if (is_null($invoice)) {
            return response()->json(['success' => false, 'message' => 'Invoice not found.']);
        }

        $path = app_path();
        $filepath = "data/pdf/";
        $filename = $filepath."testy.pdf";

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('invoicePdf', ['invoice' => $invoice, 'user' => $user]));
        $pdf->save($filename);

        $headers = 'Content-Type:application/pdf';

        return response()->file($filename,[$headers]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Invoice::with("customer")->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();

        $filteredInputAttributes = $this->filterAndValidateRequest($request);

        foreach ($filteredInputAttributes as $key => $value) {
            $customer->$key = $value;
        }

        $customer->save();

        return response()->json($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::with('items')->find($id);

        if (is_null($invoice)) {
            return response()->json(['success' => false, 'message' => 'Invoice not found.']);
        }

        return response()->json($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);

        if (is_null($invoice)) {
            return response()->json(['success' => false, 'message' => 'Invoice not found.']);
        }

        $filteredInputAttributes = $this->filterAndValidateRequest($request);

        foreach ($filteredInputAttributes as $key => $value) {
            $invoice->$key = $value;
        }
        $invoice->save();

        return response()->json($invoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Invoice not found.']);
        }

        $title = $invoice->title;

        if ($invoice->items()->delete() && $invoice->delete()) {
            return response()->json(['success' => true, 'message' => $title . ' wurde gelöscht']);
        } else {
            return response()->json(['success' => false, 'message' => 'Rechnung konnte nicht gelöscht werden.']);
        }

    }

    public function filterAndValidateRequest(Request $request)
    {
        $uModel = new Invoice();
        $fillable = $uModel->getFillable();

        $attributes = $request->all();

        foreach ($attributes as $key => $attribute) {
            if (!in_array($key, $fillable)) {
                unset($attributes[$key]);
            }
        }
        return $attributes;
    }
}
