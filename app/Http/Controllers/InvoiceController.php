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
        // dd( $request->input('qty'), $request->input('price'));

        for($i=0; $i<count($request->input('qty')); $i++){
            $result[] = $request->input('qty')[$i] * $request->input('price')[$i];
        }
        $length = $request->input('length');
        // dd($request->input('product_id'));

        // $request->input('qty')->implode(',');
        try{
            $invoice = Invoices::create([
                'subtotal' =>  array_sum($result),
                'total'    =>  array_sum($result)*0.4 + array_sum($result),
                'length'   =>  $length
          ]);
        //   dd($invoice);
        //   $invoice=Invoices::latest()->limit(1)->get();
          foreach($request->input('product_id') as $product_id){
            $product=Products::where('id', $product_id)->get();
            //   dd($invoice, $product);
            dd($product);
            // $quantity = $request->input('qty');
            //   dd($quantity);
            // $invoice->products()->attach($product->id);
            //   $invoice->products()->attach($quantity[0]);
          }

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
