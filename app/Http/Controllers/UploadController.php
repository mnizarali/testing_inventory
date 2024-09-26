<?php
namespace App\Http\Controllers;

use App\Models\OutputTemporary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;

class UploadController extends Controller
{
    public function indexOutputUpload(Request $request){
        $query = OutputTemporary::query();

    // Search by specific fields
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('bpm_no', 'like', "%{$search}%")
              ->orWhere('project_no', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('item_no', 'like', "%{$search}%");
    }

    // Paginate the results, 50 records per page
    $outputs = $query->paginate(50);

    // Return the paginated data to the view
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

    // Check if the temporary table has existing data and delete all
    if (OutputTemporary::exists()) {
        OutputTemporary::truncate(); // Delete all existing records
    }

    $batchData = [];
    for ($row = 11; $row <= $worksheet->getHighestRow(); $row++) {
        // Convert Excel date serial to PHP DateTime object
        $dateValue = $worksheet->getCell('B' . $row)->getValue();
        $date = SharedDate::isDateTime($worksheet->getCell('B' . $row)) 
                ? SharedDate::excelToDateTimeObject($dateValue)->format('Y-m-d') 
                : $dateValue;

        $projectNo = $worksheet->getCell('F' . $row)->getValue();
        
        // If project_no is empty, extract it from the description (H column)
        if (empty($projectNo)) {
            $description = $worksheet->getCell('H' . $row)->getValue();
            
            // Use regex to match patterns like '24.041' or '24.052.1'
            if (preg_match('/\d{2}\.\d{3}(\.\d{1})?/', $description, $matches)) {
                $projectNo = $matches[0]; // Capture the matched project number
            }
        }

        $batchData[] = [
            'date' => $date,
            'bpm_no' => $worksheet->getCell('D' . $row)->getValue(),
            'project_no' => $projectNo,
            'description' => $worksheet->getCell('H' . $row)->getValue(),
            'item_no' => $worksheet->getCell('J' . $row)->getValue(),
            'item_description' => $worksheet->getCell('L' . $row)->getValue(),
            'qty_out' => $worksheet->getCell('N' . $row)->getValue(),
            'unit' => $worksheet->getCell('P' . $row)->getValue(),
            'warehouse_name' => $worksheet->getCell('R' . $row)->getValue(),
        ];
    }

    // Insert all new data
    if (!empty($batchData)) {
        OutputTemporary::insert($batchData, ['timestamps' => false]);
    }

    return back()->with('success', 'Data imported successfully!');
}

    

}
