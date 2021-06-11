<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class RecommendedItem extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Products $product, Request $request)
    {
        dd($request);
    }

}
