<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //
    public function index(){
        $suppliers = Supplier::query()->paginate(10);
        return view('pages.supplier', compact('suppliers'));
    }
}
