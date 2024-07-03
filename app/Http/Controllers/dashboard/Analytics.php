<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    $total_prodcut = Product::count();
    return view('content.dashboard.dashboards-analytics', get_defined_vars());
  }
}
