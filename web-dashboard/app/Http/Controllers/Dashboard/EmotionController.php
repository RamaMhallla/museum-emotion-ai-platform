<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Emotion;

class EmotionController extends Controller
{
    public function index()
    {
        return view('pages.emotions');
    }
    public function getAll(Request $request)
    {
        $emotions = Emotion::query();

        $totalRecords    =    $emotions->count();
        $request         =    $request->all();
        $draw            =    $request['draw'];
        $row             =    $request['start'];
        $length = ($request['length'] == -1) ? $totalRecords : $request['length'];
        $rowperpage      =    $length; // Rows display per page
        $columnIndex     =    $request['order'][0]['column']; // Column index
        $columnName      =    $request['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder =    $request['order'][0]['dir']; // asc or desc
        $searchValue     =    $request['search']['value']; // Search value
        $filterValue     =    $request['filter'] ?? Null;
       

         // Validate column name for sorting
        $validColumns = ['id', 'name', 'name_it', 'created_at']; // List valid columns
        if (!in_array($columnName, $validColumns))
        {
            $columnName = 'created_at'; // Default column
        }

        ## Total number of record with filtering
        $filter = $emotions;

        if ($searchValue != '') {
            $filter->where(
                function ($query) use ($searchValue) {
                    $query->where('name', 'like', '%' . $searchValue . '%')
                          ->orWhere('name_it', 'like', '%' . $searchValue . '%')
                          ->orWhere('id', 'like', '%' . $searchValue . '%');
                }
            );
        }

        $filter_data           = $filter->count();
        $totalRecordwithFilter = $filter_data;
        $length = ($request['length'] == -1) ? $filter_data : $request['length'];
        $rowperpage      =    $length;

        ## Fetch records
        $empQuery = $filter;
        $empQuery = $empQuery->orderBy($columnName, $columnSortOrder)->offset($row)->limit($rowperpage)->get();

        $formattedOrders = [];

        $data = [];
        foreach ($empQuery as $item) {
            $emotion_data = [
                'id' => $item->id,
                'created_at' => $item->created_at->format('d/m/Y, h:i A'),
                'name' => $item->name,
                'name_it' => $item->name_it,
            ];

            $data[] = $emotion_data;
        }

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $data,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
        ]);
    }
}
