<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('pages.categories');
    }
    public function getAll(Request $request)
    {
        $categories = Category::query();

        $totalRecords    =    $categories->count();
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
        $filter = $categories;

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
            $actions = '<div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li class="text-center cursor-pointer" ><a class="dropdown-item update-account" href="javascript:;" data-id="' . $item->id . '">Update</a></li>
                                <li class="text-center cursor-pointer"><a data-id="' . $item->id . '" class="dropdown-item delete-icon delete-account">Delete</a>
                                </li> 
                            </ul>
                        </div>';
                    

            $category_data = [
                'id' => $item->id,
                'created_at' => $item->created_at->format('d/m/Y, h:i A'),
                'name' => $item->name,
                'name_it' => $item->name_it,
                'action' => $actions,
            ];

            $data[] = $category_data;
        }

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $data,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'name_it' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->name_it = $request->name_it;
        $category->save();

        return response()->json([
            "success" => "true",
            "status" => 200
        ]);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
       
        return response()->json([
            'status' => 200,
            'data' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_it' => ['required', 'string', 'max:255'],
        ]);

        // Update category fields
        $category->name = $request->name;
        $category->name_it = $request->name_it;

        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['success', 'Category Deleted Successfully!']);
    }
}
