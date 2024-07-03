<?php

namespace App\Http\Controllers\orders;

use App\Http\Controllers\Controller;
use App\Models\Product as ModelsProduct;
use Illuminate\Http\Request;

class Product extends Controller
{
  public function index()
  {
    $products = ModelsProduct::orderBy('id', 'desc')->get();
    return view('content.orders.product', get_defined_vars());
  }
}
