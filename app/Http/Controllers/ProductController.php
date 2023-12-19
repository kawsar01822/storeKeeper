<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $todaySales = $this->getSalesForDate(now());
        $yesterdaySales = $this->getSalesForDate(now()->subDay());
        $thisMonthSales = $this->getSalesForMonth(now());
        $lastMonthSales = $this->getSalesForMonth(now()->subMonth());

        return view('home', compact(
            'todaySales',
            'yesterdaySales',
            'thisMonthSales',
            'lastMonthSales'
        ));
    }

    public function products()
    {
        $products = DB::table('products')->get();
        return view('products', ['products' => $products]);
    }

    public function updatePrice(Request $request, $id)
    {
        $request->validate([
            'updated_price' => 'required|numeric|min:0',
        ]);

        DB::table('products')
            ->where('id', $id)
            ->update(['price' => $request->input('updated_price')]);

        return redirect()->back()->with('success', 'Price updated successfully!');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validation and storing logic here
        return redirect('/products')->with('success', 'Product added successfully!');
    }

    private function getSalesForDate($date)
    {
        return DB::table('transactions')
            ->whereDate('created_at', $date->toDateString())
            ->sum('total_amount');
    }

    private function getSalesForMonth($date)
    {
        return DB::table('transactions')
            ->whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->sum('total_amount');
    }

}
