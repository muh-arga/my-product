<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $products = Product::all();
        $users = User::where('role', 'user')->get();
        return view('pages.dashboard', ['type_menu' => 'dashboard', 'products' => $products, 'users' => $users]);
    }
}
