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
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        DB::table('products')->insert([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

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

    public function sellForm()
    {
        $products = DB::table('products')->get();
        return view('sellForm', ['products' => $products]);
    }

    public function sell(Request $request, $id)
    {
        $product = DB::table('products')->find($id);

        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        // Record the sale in the transactions table
        DB::table('transactions')->insert([
            'product_id' => $product->id,
            'quantity_sold' => $request->input('quantity'),
            'total_amount' => $request->input('quantity') * $product->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Update the product quantity
        DB::table('products')
            ->where('id', $product->id)
            ->update(['quantity' => DB::raw('quantity - ' . $request->input('quantity'))]);

        return redirect('/sell')->with('success', 'Product added successfully!');
    }

}
