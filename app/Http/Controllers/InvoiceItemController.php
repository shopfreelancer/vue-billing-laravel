<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InvoiceItem;
use PhpParser\Node\Expr\Cast\Object_;

class InvoiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoiceItem = new InvoiceItem();

        $filteredInputAttributes = $this->filterAndValidateRequest($request);

        foreach ($filteredInputAttributes as $key => $value) {
            $invoiceItem->$key = $value;
        }
        $invoiceItem->save();

        return response()->json($invoiceItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoiceItem = InvoiceItem::find($id);

        if(is_null($invoiceItem)){
            return response()->json(['success' => false, 'message' => 'Item not found.']);
        }

        $filteredInputAttributes = $this->filterAndValidateRequest($request);

        foreach ($filteredInputAttributes as $key => $value) {
            $invoiceItem->$key = $value;
        }

        $invoiceItem->save();

        return response()->json($invoiceItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $invoiceItem = InvoiceItem::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Item not found.']);
        }

        $title = $invoiceItem->title;

        if ($invoiceItem->delete()) {
            return response()->json(['success' => true, 'message' => $title . ' wurde gelöscht']);
        } else {
            return response()->json(['success' => false, 'message' => 'Item konnte nicht gelöscht werden.']);
        }

    }

    public function filterAndValidateRequest($request)
    {
        $uModel = new InvoiceItem();
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
