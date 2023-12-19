<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = DB::table('transactions')
            ->join('products', 'transactions.product_id', '=', 'products.id')
            ->select('transactions.*', 'products.name as product_name')
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        return view('transactions', ['transactions' => $transactions]);
    }
}
