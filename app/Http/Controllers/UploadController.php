<?php
namespace App\Http\Controllers;

use App\Models\OutputTemporary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UploadController extends Controller
{
    public function indexOutputUpload(){
        $outputs = OutputTemporary::get();
        return view('pages.upload.output-upload', compact('outputs'));
    }


public function outputImport(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    $file = $request->file('file')->getRealPath();
    $spreadsheet = IOFactory::load($file);
    $worksheet = $spreadsheet->getActiveSheet();

    // Using chunking to handle large data sets more efficiently
    $batchData = [];
    for ($row = 11; $row <= $worksheet->getHighestRow(); $row++) {
        $batchData[] = [
            'date' => $worksheet->getCell('B' . $row)->getValue(),
            'bpm_no' => $worksheet->getCell('D' . $row)->getValue(),
            'project_no' => $worksheet->getCell('F' . $row)->getValue(),
            'description' => $worksheet->getCell('H' . $row)->getValue(),
            'item_no' => $worksheet->getCell('J' . $row)->getValue(),
            'item_description' => $worksheet->getCell('L' . $row)->getValue(),
            'qty_out' => $worksheet->getCell('N' . $row)->getValue(),
            'unit' => $worksheet->getCell('P' . $row)->getValue(),
            'warehouse_name' => $worksheet->getCell('R' . $row)->getValue(),
        ];

        // Insert in chunks for better performance
        if (count($batchData) == 500) {
            OutputTemporary::insert($batchData, ['timestamps' => false]);
            $batchData = []; // Clear the batch after insertion
        }
    }

    // Insert remaining batch if any
    if (!empty($batchData)) {
        OutputTemporary::insert($batchData, ['timestamps' => false]);
    }

    return back()->with('success', 'Data imported successfully!');
}

}
