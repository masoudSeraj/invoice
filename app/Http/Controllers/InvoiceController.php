<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Products::all();
        return view('admin.invoice');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request);
        for($i=0; $i<count($request->input('qty')); $i++){
            $result[] = $request->input('qty')[$i] * $request->input('price')[$i];
        }
        $length = $request->input('length');

        try{
            $invoice = Invoices::create([
                'subtotal' =>  array_sum($result),
                'total'    =>  array_sum($result)*0.4 + array_sum($result),
                'length'   =>  $length
          ]);
        //   dd($invoice);
            $invoice=Invoices::latest()->limit(1)->get();
            $products=$request->input('product_id');

            $invoice->products()->attach([2,3,4]);

        }
        catch(\Exception $e){
            return $e->getMessage();
        }

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

    public function create()
    {
        return view('admin.create_invoice');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
