<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class RecommendedList extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $randProducts = Products::inRandomOrder()->get();
        $products = Products::all();
        return view('admin.autocomplete',[
            'products' => $products
        ]);
    }
}
