<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class ManagingController extends Controller
{
    //product 
    public function indexProduct() {
        $products = Product::OrderBy('updated_at','desc')->paginate(10);
        return view('pages.managing.product', compact('products'));
    }

    public function storeProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'img'          => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate product code
        $yearMonthDay = now()->format('ymd');
        $productCount = Product::count();
        $nextNumber = str_pad($productCount + 1, 2, '0', STR_PAD_LEFT);
        $code = substr($request->product_name, 0, 1) . $yearMonthDay . $nextNumber;

        $file = $request->img;
        $extension = $file->getClientOriginalExtension();
        $filename = $code . '-'.  time() . '.' . $extension;
        $path = 'uploads/product/img';

        if (!$file->move(public_path($path), $filename)) {
            return redirect()->back()->with('error', 'File upload failed');
        }

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->stock = 0;
        $product->img = $filename;
        $product->code = $code;
        $product->save();

        return redirect()->route('managing.product')->with('success', 'Product successfully created');
    }

    public function deleteProduct($id)
{
    // Retrieve the product by ID
    $product = Product::find($id);
    if ($product->stock > 0) {
        return redirect()->back()->with('fail','masih ada stock');
    }
    // Check if the product exists
    if ($product) {
        // Define the path to the image
        $imagePath = public_path('uploads/product/img/' . $product->img);

        // Check if the image file exists and delete it
        if (file_exists($imagePath)) {
            unlink($imagePath);  // This deletes the image file
        }

        // Delete the product from the database
        $product->delete();

        // Redirect with a success message
        return redirect()->route('managing.product')
            ->with('success', 'Product successfully deleted');
    } else {
        // Redirect with a failure message if product is not found
        return redirect()->route('managing.product')
            ->with('fail', 'Product not found');
    }
}



    // Supplier Menu
    public function indexSupplier()
    {
        $suppliers = Supplier::Orderby('updated_at', 'desc')->paginate(10);
        $categories = SupplierCategory::all();
        return view('pages.managing.supplier', compact('suppliers', 'categories'));
    }

    public function storeSupplier(Request $request)
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

        return redirect()->route('managing.supplier') // Sesuaikan dengan rute Anda
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    public function editSupplier(Request $request, $id)
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
    
        return redirect()->route('managing.supplier') // Adjust the route as necessary
            ->with('success', 'Supplier berhasil diperbarui');
    }

    public function deleteSupplier($id)
    {
        $supplier = Supplier::where('id', $id)->first();

        if ($supplier) {
            $supplier->delete();
            return redirect()->route('managing.supplier')
                ->with('success', 'Supplier berhasil dihapus');
        } else {
            return redirect()->route('managing.supplier')
                ->with('fail', 'Supplier tidak ditemukan');
        }
    }

    public function indexSupplierCategory()
    {
        $categories = SupplierCategory::OrderBy('updated_at', 'desc')->paginate(10);
        return view('pages.managing.supplierCategory', compact('categories'));
    }

    public function storeSupplierCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $existingSupplierCategory = SupplierCategory::where('name', $request->name)->first();

        if ($existingSupplierCategory) {
            return redirect()->back()
                ->with('fail', 'Data sudah tersedia')
                ->withInput();
        }

        // Simpan data baru jika validasi lulus dan data tidak ada
        $supplier = new SupplierCategory();
        $supplier->name = $request->name;
        $supplier->description = $request->description;
        $supplier->save();

        return redirect()->route('managing.supplier.category') // Sesuaikan dengan rute Anda
            ->with('success', 'Category berhasil ditambahkan');
    }

    public function editSupplierCategory(Request $request, $id)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find the existing supplier category by ID
        $supplierCategory = SupplierCategory::find($id);

        if (!$supplierCategory) {
            return redirect()->back()
                ->with('fail', 'Category tidak ditemukan');
        }

        // Check for a duplicate category name, excluding the current record
        $existingSupplierCategory = SupplierCategory::where('name', $request->name)
                                                    ->where('description', $request->description)
                                                    ->first();

        if ($existingSupplierCategory) {
            return redirect()->route('managing.supplier.category')
                ->with('nothing', 'Tidak ada data yang diubah')
                ->withInput();
        }

        // Update the supplier category with new data
        $supplierCategory->name = $request->name;
        $supplierCategory->description = $request->description;
        $supplierCategory->save();

        return redirect()->route('managing.supplier.category') // Adjust the route as necessary
            ->with('success', 'Category berhasil diperbarui');
    }

    public function deleteSupplierCategory($id)
    {
        $category = SupplierCategory::where('id', $id)->first();

        if ($category) {
            $category->delete();
            return redirect()->route('managing.supplier.category')
                ->with('success', 'Supplier berhasil dihapus');
        } else {
            return redirect()->route('managing.supplier.category')
                ->with('fail', 'Supplier tidak ditemukan');
        }
    }

    public function indexUser(){
        $users = User::OrderBy('updated_at', 'desc')->paginate(10);
        return view('pages.managing.user', compact('users'));
    }

    // Employees 
    public function indexEmployee() {
        $employees = Employee::with('department', 'division')->get();
        $departments = Department::all();
        $divisions = Division::all();
        return view('pages.managing.employee', compact('employees', 'departments', 'divisions'));
    }

    public function storeEmployee(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required',
            'phone_number' => 'required',
            'department_id' => 'required',
            'division_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $existingEmployee = Employee::where('fullname', $request->fullname)
                            ->where('email', $request->email)
                            ->first();

        if ($existingEmployee) {
            return redirect()->route('managing.employee')
                ->with('fail', 'Data sudah tersedia')
                ->withInput();
        }

        $employee = new Employee();
        $employee->fullname = $request->fullname;
        $employee->email = $request->email;
        $employee->phone_number = $request->phone_number;
        $employee->department_id = $request->department_id;
        $employee->division_id = $request->division_id;
        $employee->position = $request->position;
        $employee->save();

        return redirect()->route('managing.employee')
            ->with('success', 'Employee berhasil ditambahkan');
    }

    public function editEmployee(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required',
            'phone_number' => 'required',
            'department_id' => 'required',
            'division_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $employee = Employee::find($id);
        if (!$employee) {
            return redirect()->back()
                ->with('fail', 'Employee tidak ditemukan');
        }

        $existingEmployee = Employee::where('fullname', $request->fullname)
                                    ->where('email', $request->email)
                                    ->where('phone_number', $request->phone_number)
                                    ->where('department_id', $request->department_id)
                                    ->where('division_id', $request->division_id)
                                    ->where('position', $request->position)
                                    ->first();

        if ($existingEmployee) {
            return redirect()->back()
                ->with('nothing', 'Tidak ada data yang diubah')
                ->withInput();
        }
        
        $employee->fullname = $request->fullname;
        $employee->email = $request->email;
        $employee->phone_number = $request->phone_number;
        $employee->department_id = $request->department_id;
        $employee->division_id = $request->division_id;
        $employee->position = $request->position;
        $employee->save();

        return redirect()->route('managing.employee') // Adjust the route as necessary
        ->with('success', 'Employee berhasil diperbarui');

    }

    public function deleteEmployee($id) {
        $employee = Employee::where('id', $id)->first();

        if ($employee) {
            $employee->delete();
            return redirect()->route('managing.employee')
                ->with('success', 'Employee berhasil dihapus');
        } else {
            return redirect()->route('managing.employee')
                ->with('err', 'Employee tidak ditemukan');
        }
    }

    // Department & Division
    public function indexDepartment() {
        $departments = Department::OrderBy('updated_at', 'desc')->paginate(10);
        return view('pages.managing.department', compact('departments'));
    }

    public function storeDepartment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $existingDepartment = Department::where('department_name', $request->department_name)->first();

        if ($existingDepartment) {
            return redirect()->back()
                ->with('fail', 'Data sudah tersedia')
                ->withInput();
        }

        // Simpan data baru jika validasi lulus dan data tidak ada
        $supplier = new Department();
        $supplier->department_name = $request->department_name;
        $supplier->save();

        return redirect()->route('managing.department') // Sesuaikan dengan rute Anda
            ->with('success', 'Category berhasil ditambahkan');
    }

    public function editDepartment(Request $request, $id) {
        $validator = Validator::make($request->all(),[
            'department_name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $department = Department::find($id);
        if (!$department) {
            return redirect()->back()
                ->with('fail', 'Department tidak ditemukan');
        }
        $existingDepartment = Department::where('department_name', $request->department_name)
            ->first();

        if ($existingDepartment) {
            return redirect()->back()
                ->with('nothing', 'Tidak ada data yang diubah')
                ->withInput();
        }
        
        $department->department_name = $request->department_name;
        $department->save();

        return redirect()->route('managing.department') // Adjust the route as necessary
        ->with('success', 'Department berhasil diperbarui');

    }

    public function deleteDepartment($id) {
        $department = Department::where('id', $id)->first();

        if ($department) {
            $department->delete();
            return redirect()->route('managing.department')
                ->with('success', 'Department berhasil dihapus');
        } else {
            return redirect()->route('managing.department')
                ->with('fail', 'Department tidak ditemukan');
        }
    }

    public function indexDivision(){
        $divisions = Division::with(['department'])->get();
        $departments = Department::all();
        return view('pages.managing.division', compact('divisions', 'departments'));
    }

    public function storeDivision(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'division_name' => 'required|string|max:255',
            'department_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $existingDivision = Division::where('division_name', $request->division_name)
                            ->where('department_id', $request->department_id)
                            ->first();

        if ($existingDivision) {
            return redirect()->back()
                ->with('fail', 'Data sudah tersedia')
                ->withInput();
        }

        $division = new Division();
        $division->division_name = $request->division_name;
        $division->department_id = $request->department_id;
        $division->save();

        return redirect()->route('managing.division')
            ->with('success', 'Division berhasil ditambahkan');
    }

    public function editDivision(Request $request, $id) {
        $validator = Validator::make($request->all(),[
            'division_name' => 'required|string',
            'department_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $division = Division::find($id);
        if (!$division) {
            return redirect()->back()
                ->with('fail', 'Division tidak ditemukan');
        }
        $existingdivision = Division::where('division_name', $request->division_name)
                                    ->where('department_id', $request->department_id)
                                    ->first();

        if ($existingdivision) {
            return redirect()->back()
                ->with('nothing', 'Tidak ada data yang diubah')
                ->withInput();
        }
        
        $division->division_name = $request->division_name;
        $division->department_id = $request->department_id;
        $division->save();

        return redirect()->route('managing.division')
        ->with('success', 'Division berhasil diperbarui');

    }

    public function deleteDivision($id) {
        $division = Division::where('id', $id)->first();

        if ($division) {
            $division->delete();
            return redirect()->route('managing.division')
                ->with('success', 'Division berhasil dihapus');
        } else {
            return redirect()->route('managing.division')
                ->with('err', 'Division tidak ditemukan');
        }
    }
    

}
