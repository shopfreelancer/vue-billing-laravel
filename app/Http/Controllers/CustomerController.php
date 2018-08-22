<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::withCount('tickets')->get();
        return response()->json($customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = new Customer();
        $customer->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activityInput = $request->all();
        $activity = new Activity($activityInput);
        $activity->save();

        return response()->json($this->convertActivityToSnakeArray($activity));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Customer::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $customer = Customer::find($id);

        if(isNull($customer)){
            return response()->json(['success' => false, 'message' => 'Customer not found.']);
        }

        $filteredInputAttributes = $this->filterAndValidateRequest($request);

        foreach ($filteredInputAttributes as $key => $value) {
            $customer->$key = $value;
        }
        $customer->save();

        return response()->json($customer);
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
            $customer = Customer::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['success' => false, 'message' => 'Customer not found.']);
        }

        $title = $customer->fullname;

        if ($customer->delete()) {
            return response()->json(['success' => true, 'message' => $title . ' wurde gelöscht']);
        } else {
            return response()->json(['success' => false, 'message' => 'Kunde konnte nicht gelöscht werden.']);
        }

    }

    public function filterAndValidateRequest($request)
    {
        $uModel = new Customer();
        $fillable = $uModel->getFillable();

        $attributes = $request->all();
        foreach ($attributes as &$attribute) {
            if (!in_array($attribute, $fillable)) {
                unset($attribute);
            }
        }
        unset($attribute);

        return $attributes;
    }
}
