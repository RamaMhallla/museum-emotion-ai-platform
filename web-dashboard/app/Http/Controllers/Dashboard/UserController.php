<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.users');
    }
    public function getAll(Request $request)
    {
        $users = User::query();
        $users = $users->role('user');

        $totalRecords    =    $users->count();
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
        $validColumns = ['id', 'name', 'email', 'created_at']; // List valid columns
        if (!in_array($columnName, $validColumns))
        {
            $columnName = 'created_at'; // Default column
        }

        ## Total number of record with filtering
        $filter = $users;

        if ($searchValue != '') {
            $filter->where(
                function ($query) use ($searchValue) {
                    $query->where('name', 'like', '%' . $searchValue . '%')
                        ->orWhere('email', 'like', '%' . $searchValue . '%')
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
        $empQuery = $empQuery->role('user')->orderBy($columnName, $columnSortOrder)->offset($row)->limit($rowperpage)->get();

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
                    

            $user_data = [
                'id' => $item->id,
                'created_at' => $item->created_at->format('d/m/Y, h:i A'),
                'name' => $item->name,
                'email' => $item->email,
                'action' => $actions,
            ];

            $data[] = $user_data;
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
            'user_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $user = new User();
        $user->name = $request->user_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole('user');

        return response()->json([
            "success" => "true",
            "status" => 200
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
       
        return response()->json([
            'status' => 200,
            'data' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id), // ignore current user's email
            ],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        // Update user fields
        $user->name = $request->user_name;
        $user->email = $request->email;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success', 'User Deleted Successfully!']);
    }
}
