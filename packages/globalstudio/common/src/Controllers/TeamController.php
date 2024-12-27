<?php

namespace GlobalStudio\Common\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use GlobalStudio\Common\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    protected $folderPath, $path;
    public function __construct()
    {
        $this->folderPath = 'storage/team/'; 
        $this->path = public_path($this->folderPath); 
    
        if (!file_exists($this->path)) {
            mkdir($this->path, 0755, true); 
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('common::team.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('common::team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|unique:teams,name',
            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot create')->withInput()->withErrors($validator);
            }

            $imageName = '';
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move($this->folderPath, $imageName);
            }

            $team = Team::Create([
                "name"      => $request->name,
                "slug"      => $request->slug,
                "facebook"  => $request->facebook,
                "google" => $request->google,
                "twitter"   => $request->twitter,
                "linkedin"   => $request->linkedin,
                "image"     => $imageName,
                'employee_type'=>$request->employee_type,
                "status"    => ($request->status == 'on') ? 1 : 0,
                "added_by"  => Auth::user()->id,
                'description'=>$request->description,
                'is_top'=>$request->is_top,
            ]);

            return redirect()->route('admin.team.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {
            // dd($ex);
            return redirect()->route('admin.team.index')->with('error', 'Something went wrong!!');
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
        $team  = Team::findorFail($id);
        return view('common::team.view', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team  = Team::findorFail($id);
        $users = User::where('status', 1)->get();
        return view('common::team.edit', compact('team', 'users'));
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
            $id        = $request->id;
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|unique:teams,name,' . $id,
            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot edit')->withInput()->withErrors($validator);
            }

            $team            = Team::findorFail($id);
            $team->name      = $request->name;
            $team->slug      = $request->slug;
            $team->facebook  = $request->facebook;
            $team->google = $request->google;
            $team->linkedin  = $request->linkedin;
            $team->twitter   = $request->twitter;
            $team->status    = ($request->status == 'on') ? 1 : 0;
            $team->employee_type=$request->employee_type;
            $team->is_top=$request->is_top;
            if ($request->hasFile('image')) {
                $old_img=$team->image;
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move($this->folderPath, $imageName);
                $team->image = $imageName;
                if($old_img){
                    unlink($this->path.$old_img);
                }
            }

            $team->save();

            return redirect()->route('admin.team.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {
            dd($ex);
            return redirect()->route('admin.team.index')->with('error', 'Something went wrong!!');
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
            $team=Team::where('id', $request->id)->first();
            if($team->image){
                unlink($this->path.$team->image);
            }
            $team->delete();
            return redirect()->route('admin.team.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception $ex) {

            return redirect()->route('admin.team.index')->with('error', 'Something went wrong!!');
        }
    }
    public function search(Request $request)
    {
        try {
            ## Read value
            $draw     = intval($request->get('draw'));
            $start    = intval($request->get("start"));
            $paginate = intval($request->get("length", env('PAGINATION', 15))); // Rows display per page

            $page = intval(($start / $paginate) + 1);
            $request->merge(['page' => $page]);

            $columnIndex_arr = $request->get('order');
            $columnName_arr  = $request->get('columns');

            $order_arr  = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column']; // Column index

            $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc

            $keyword = $request->keyword;
            ## End Read values

            $result = Team::query();
            $result = $result->Where(function ($query) use ($keyword) {
                if (null != $keyword) {
                    $query->where('teams.name', 'LIKE', '%' . $keyword . '%');
                }
            })
                ->latest()
                ->paginate($paginate);
            // dd($result);
            $data_arr = array();

            $sn = 1;
            foreach ($result as $record) {

                // dd($group_id)

                $data_arr[] = array(
                    "sn"     => $sn,
                    "id"     => $record->id,
                    "name"   => $record->name,
                    "status" => $record->status,
                    "action" => '',

                );

                $sn++;
            }

            $response = array(
                "draw"            => intval($draw),
                "recordsTotal"    => $result->total(),
                "recordsFiltered" => $result->total(),
                "total_amount"    => 0,
                "data"            => $data_arr,
            );

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array(
                "error"           => $e->getMessage(),
                "draw"            => intval($draw),
                "recordsTotal"    => 0,
                "recordsFiltered" => 0,
                "total_amount"    => 0,
                "data"            => []
            );

            return response()->json($response, 500);
        }
    }
}
