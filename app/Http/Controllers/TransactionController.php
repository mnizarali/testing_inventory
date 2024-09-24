<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierCategory;
use App\Models\Stock;
use App\Models\TransactionHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;

class TransactionController extends Controller
{
    public function indexStockin() {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('pages.transaction.stockin', compact('products', 'suppliers'));
    }

    public function storeStockin(Request $request) {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'supplier_id' => 'required',
            'transaction_date' => 'required',
            'quantity' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $getUserLogin = Auth::id();

        $stockin = new Stock();
        $stockin->product_id = $request->product_id;
        $stockin->quantity = $request->quantity;
        $stockin->supplier_id = $request->supplier_id;
        $stockin->status = 'in';
        $stockin->create_by_user_id = $getUserLogin;
        $stockin->transaction_date = Carbon::createFromFormat('Y-m-d', $request->transaction_date)->format('Y-m-d');;
        $stockin->description = $request->description;
        $stockin->save();

         // Update product stock
         $product = Product::find($request->product_id);
        if ($product) {
            $product->stock += $request->quantity;
            $product->save(); 
        }

        
        $transactionId = 'TR/IN' . '/' . Carbon::now()->format('Y/m/d');
        $productName = Product::where('id', $request->product_id)->select('product_name')->first()->product_name;
        $create_by_user_name = Auth::user()->username;
        $productSupplier = Supplier::where('id', $request->supplier_id)->select('company_name')->first()->company_name;

        $transactionHistory = new TransactionHistory();
        $transactionHistory->transaction_id = $transactionId;
        $transactionHistory->product = $productName;
        $transactionHistory->quantity = $request->quantity;
        $transactionHistory->status = 'in';
        $transactionHistory->supplier = $productSupplier;
        $transactionHistory->transaction_date = $request->transaction_date;
        $transactionHistory->create_by_user = $create_by_user_name;
        $transactionHistory->description = $request->description;
        $transactionHistory->save();

        return redirect()->route('transaction.stockin')->with('success', 'transaksi berhasil');
    }

    public function indexStockout() {
        $products = Product::all();
        return view('pages.transaction.stockout', compact('products'));
    }

    public function storeStockout(Request $request) {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'transaction_date' => 'required|date_format:Y-m-d',
            'quantity' => 'required|integer|min:1' // Ensure quantity is a positive integer
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Get the last stock of the product
        $product = Product::find($request->product_id);
        if (!$product) {
            return redirect()->back()->withInput()->with('fail', 'Product not found');
        }
    
        // Check if stock is sufficient
        if ($request->quantity > $product->stock) {
            return redirect()->back()->withInput()->with('fail', 'Stock tidak cukup');
        }
    
        // Get the logged-in user's ID
        $getUserLogin = Auth::id();
    
        // Create a new stock-out record
        $stockout = new Stock();
        $stockout->product_id = $request->product_id;
        $stockout->quantity = $request->quantity;
        $stockout->status = 'out';
        $stockout->create_by_user_id = $getUserLogin; // Correct the field name
        $stockout->transaction_date = Carbon::createFromFormat('Y-m-d', $request->transaction_date)->format('Y-m-d');
        $stockout->description = $request->description;
        $stockout->save();
    
        // Update the product stock
        $product->stock -= $request->quantity; // Subtract the quantity from the stock
        $product->save();

        $transactionId = 'TR/OUT' . '/' . Carbon::now()->format('Y/m/d');
        $productName = Product::where('id', $request->product_id)->select('product_name')->first()->product_name;
        $create_by_user_name = Auth::user()->username;

        $transactionHistory = new TransactionHistory();
        $transactionHistory->transaction_id = $transactionId;
        $transactionHistory->product = $productName;
        $transactionHistory->quantity = $request->quantity;
        $transactionHistory->status = 'out';
        $transactionHistory->transaction_date = $request->transaction_date;
        $transactionHistory->create_by_user = $create_by_user_name;
        $transactionHistory->description = $request->description;
        $transactionHistory->save();
    
        return redirect()->route('transaction.stockout')->with('success', 'Transaksi berhasil');
    }

    public function indexStockmanager () {
        $stocks = Stock::with('product', 'supplier', 'user')->paginate(5);
        Return view('pages.transaction.stockmanager', compact('stocks'));
    }
    
}
