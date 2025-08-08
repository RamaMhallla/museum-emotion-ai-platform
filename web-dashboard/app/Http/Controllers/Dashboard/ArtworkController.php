<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Artwork;
use App\Models\Category;

class ArtworkController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('pages.artworks', compact('categories'));
    }
    public function getAll(Request $request)
    {
        $artworks = Artwork::query();
        //$artworks = Artwork::with(['uploader', 'category']);

        $totalRecords    =    $artworks->count();
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
        $validColumns = ['id', 'title', 'title_it', 'artist_name', 'year_created', 'created_at']; // List valid columns
        if (!in_array($columnName, $validColumns))
        {
            $columnName = 'created_at'; // Default column
        }

        ## Total number of record with filtering
        $filter = $artworks;

        if ($searchValue != '') {
            $filter->where(
                function ($query) use ($searchValue) {
                    $query->where('title', 'like', '%' . $searchValue . '%')
                      ->orWhere('artist_name', 'like', '%' . $searchValue . '%')
                      ->orWhere('title_it', 'like', '%' . $searchValue . '%');
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
                    

            $artwork_data = [
                'id' => $item->id,
                'title' => $item->title,
                'title_it' => $item->title_it,
                'image_path' => $item->image_path,
                'artist_name' => $item->artist_name ?? 'N/A',
                'year_created' => $item->year_created ?? 'N/A',
                'created_at' => $item->created_at->format('d/m/Y, h:i A'),
                'category_name' => $item->category->name ?? 'N/A',
                'action' => $actions,
            ];

            $data[] = $artwork_data;
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
            'title' => 'required|string|max:255',
            'title_it' => 'required|string|max:255',
            'description' => 'nullable|string',
            'description_it' => 'nullable|string',
            'artist_name' => 'nullable|string|max:255',
            'year_created' => 'nullable|string|max:4',
            'uploaded_by' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $artwork = new Artwork();
        $artwork->title = $request->title;
        $artwork->title_it = $request->title_it;
        $artwork->description = $request->description;
        $artwork->description_it = $request->description_it;
        $artwork->artist_name = $request->artist_name;
        $artwork->year_created = $request->year_created;
        $artwork->uploaded_by = $request->uploaded_by ?? 1;
        $artwork->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $destinationPath = 'uploads/artworks/';
            $storagePath = $file->storeAs('public/' . $destinationPath, $filename);
            $file->move($destinationPath, $filename);
            $artwork->image_path = $destinationPath . $filename;
        }
        $artwork->save();

        return response()->json([
            "success" => "true",
            "status" => 200
        ]);
    }

    public function edit($id)
    {
        $artwork = Artwork::findOrFail($id);
       
        return response()->json([
            'status' => 200,
            'data' => $artwork,
        ]);
    }

    public function update(Request $request, $id)
    {
        $artwork = Artwork::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'title_it' => 'required|string|max:255',
            'description' => 'nullable|string',
            'description_it' => 'nullable|string',
            'artist_name' => 'nullable|string|max:255',
            'year_created' => 'nullable|string|max:4',
            'uploaded_by' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Update artwork fields
        $artwork->title = $request->title;
        $artwork->title_it = $request->title_it;
        $artwork->description = $request->description;
        $artwork->description_it = $request->description_it;
        $artwork->artist_name = $request->artist_name;
        $artwork->year_created = $request->year_created;
        $artwork->category_id = $request->category_id;

        if ($request->hasFile('Profile_Photo')) {
            $image_dir = 'uploads/profile/';
            $path = $image_dir . $driver_info->Profile_Photo;
            File::delete($path);

            $file = $request->file('Profile_Photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $destinationPath = $image_dir;
            $file->move($destinationPath, $filename);
            $driver_info->Profile_Photo = $image_dir . $filename;
        }

        $artwork->save();

        return response()->json([
            'success' => true,
            'message' => 'Artwork updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $artwork = Artwork::findOrFail($id);
        $artwork->delete();

        return response()->json(['success', 'Artwork Deleted Successfully!']);
    }
}
