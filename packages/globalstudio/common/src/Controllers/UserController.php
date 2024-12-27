<?php

namespace GlobalStudio\Common\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use GlobalStudio\Common\Models\Department;
use GlobalStudio\Common\Models\Branch;
use GlobalStudio\Common\Models\Team;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        return view('common::user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $departments = Department::all();
        $branches = Branch::all();
        return view('common::user.create',compact('departments','branches'));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // abort_if(!auth()->user()->can('user_create'), 403);
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|same:confirm-password',
                'mobile' => 'required|unique:users,mobile,',
                'username' => 'required|unique:users,username,',
                // 'branch_id' => 'required',
                // 'department_id' => 'required',
                'role' => 'required',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Couldnot create')->withInput()->withErrors($validator);
            }

            $image_url = '';
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move(public_path('/images/users'), $imageName);
                $image_url = 'images/users/'.$imageName;
            }

                $user = User::Create([
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                    "mobile" => $request->mobile,
                    "role" => $request->role,
                    "department_id" => $request->department_id,
                    "branch_id" => $request->branch_id,
                    "username" => $request->username,
                    "status" => ($request->status == 'on') ? 1 : 0,
                    "image" => $image_url,
                ]);
            if($request->is_team == 'on'){
                $team = Team::Create([
                    "name"      => $request->name,
                    "email"     => $request->email,
                    "mobile"    => $request->mobile,
                    "title"     => $request->role,
                    "facebook"  => $request->facebook,
                    "instagram" => $request->instagram,
                    "twitter"   => $request->twitter,
                    "youtube"   => $request->youtube,
                    "image"     => $image_url,
                    "status"    => ($request->status == 'on') ? 1 : 0,
                    "added_by"  => \Auth::user()->id,
                ]);
            }
           
            return redirect()->route('admin.user.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('admin.user.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::all();
        $branches = Branch::all();
        $user = User::findorFail($id);
        return view('common::user.edit', compact('user','departments','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email,'. $id,
                // 'password' => 'required|min:6|same:confirm-password',
                // 'code' => 'required|unique:users,code,',
                'mobile' => 'required|unique:users,mobile,'. $id,
                'username' => 'required',
                // 'branch_id' => 'required',  
                // 'department_id' => 'required',
                'role' => 'required',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Couldnot edit')->withInput()->withErrors($validator);
            }

           
            $user = User::findorFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username; 
            $user->mobile = $request->mobile;
            $user->role = $request->role;
            $user->department_id = $request->department_id;
            $user->branch_id = $request->branch_id;
            $user->status = ($request->status == 'on') ? 1 : 0;

            $profile_url = '';
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move(public_path('/images/users'), $imageName);
                $profile_url = $imageName;
                $user->image = '/images/users/'.$imageName;
            }
           $user->save();

            return redirect()->route('admin.user.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('admin.user.index')->with('error', 'Something went wrong!!');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
     

        try {
            User::where('id',$request->id)->delete();
            return redirect()->route('admin.user.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception $ex) {

            return redirect()->route('admin.user.index')->with('error', 'Something went wrong!!');

        }

    }
    public function search(Request $request)
    {
        try {
            ## Read value
            $draw = intval($request->get('draw'));
            $start = intval($request->get("start"));
            $paginate = intval($request->get("length", env('PAGINATION', 15))); // Rows display per page

            $page = intval(($start / $paginate) + 1);
            $request->merge(['page' => $page]);

            $columnIndex_arr = $request->get('order');
            $columnName_arr = $request->get('columns');

            $order_arr = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column']; // Column index

            $columnName = $columnName_arr[$columnIndex]['data']; // Column name
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc

            $keyword = $request->keyword;
            ## End Read values
            
            $result = User::query();
            $result = $result->Where(function ($query) use ($keyword) {
                if (null != $keyword) {
                    $query->where('users.name', 'LIKE', '%' . $keyword . '%');
                    $query->orWhere('users.email', 'LIKE', '%' . $keyword . '%');
                    $query->orwhere('users.mobile', 'LIKE', '%' . $keyword . '%');
                }
            })
                ->latest()
                ->paginate($paginate);
            $data_arr = array();

            $sn = 1;
            foreach ($result as $record) {
                $data_arr[] = array(
                    "sn" => $sn,
                    "id" => $record->id,
                    "name" => $record->name,
                    "email" => $record->email,
                    "mobile" => $record->mobile,
                    "role" => $record->role,
                    "status" => $record->status,
                    "action" => '',
                );

                $sn++;
            }

            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $result->total(),
                "recordsFiltered" => $result->total(),
                "total_amount" => 0,
                "data" => $data_arr,
            );

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array(
                "error" => $e->getMessage(),
                "draw" => intval($draw),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "total_amount" => 0,
                "data" => []
            );

            return response()->json($response, 500);
        }
    }

}
