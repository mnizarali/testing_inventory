<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterDataController extends Controller
{
    // Vendor (supplier)
    public function indexVendor()
    {
        $suppliers = Supplier::Orderby('updated_at', 'desc')->paginate(10);
        $categories = SupplierCategory::all();
        return view('pages.master.vendor', compact('suppliers', 'categories'));
    }

    public function storeVendor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cek apakah sudah ada data dengan company_name dan category yang sama
        $existingSupplier = Supplier::where('company_name', $request->company_name)
            ->where('category', $request->category)
            ->first();

        if ($existingSupplier) {
            return redirect()->back()
                ->with('fail', 'Data sudah tersedia')
                ->withInput();
        }

        // Simpan data baru jika validasi lulus dan data tidak ada
        $supplier = new Supplier();
        $supplier->company_name = $request->company_name;
        $supplier->category = $request->category;
        $supplier->contact_name = $request->contact_name;
        $supplier->phone_number = $request->phone_number;
        $supplier->address = $request->address;
        $supplier->description = $request->description;
        $supplier->save();

        return redirect()->route('master.vendor') // Sesuaikan dengan rute Anda
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    public function editVendor(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $supplier = Supplier::find($id);
        if (!$supplier) {
            return redirect()->back()
                ->with('fail', 'Category tidak ditemukan');
        }
        $existingSupplier = Supplier::where('company_name', $request->company_name)
                                    ->where('category', $request->category)
                                    ->first();

        if ($existingSupplier) {
            return redirect()->back()
                ->with('nothing', 'Data sudah tersedia')
                ->withInput();
        }
        $supplier->company_name = $request->company_name;
        $supplier->category = $request->category;
        $supplier->contact_name = $request->contact_name;
        $supplier->phone_number = $request->phone_number;
        $supplier->address = $request->address;
        $supplier->description = $request->description;
        $supplier->save();
    
        return redirect()->route('master.vendor') // Adjust the route as necessary
            ->with('success', 'Supplier berhasil diperbarui');
    }

    public function deleteVendor($id)
    {
        $supplier = Supplier::where('id', $id)->first();

        if ($supplier) {
            $supplier->delete();
            return redirect()->route('master.vendor')
                ->with('success', 'Supplier berhasil dihapus');
        } else {
            return redirect()->route('master.vendor')
                ->with('fail', 'Supplier tidak ditemukan');
        }
    }

    
}
