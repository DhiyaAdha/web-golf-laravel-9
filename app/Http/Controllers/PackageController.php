<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageDefault;
use App\Models\PackageAdditional;

class PackageController extends Controller
{
    public function item() {
        $products = PackageDefault::orderBy('id')->get();
        // return response()->json($products);
        return view('package.package', compact ('products'));
    }
}
