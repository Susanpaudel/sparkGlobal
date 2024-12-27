<?php

namespace GlobalStudio\Common\Controllers;

use App\Http\Controllers\Controller;
use GlobalStudio\Common\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
class SliderController extends Controller
{

    protected $folderPath, $path;
    public function __construct()
    {
        $this->folderPath = 'storage/slider/'; 
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

        return view('common::slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('common::slider.create');

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
                'title' => 'required|max:255',  
                'sub_title'=>'required|max:255',
                'body'=>'required',
                'image'=>'required',
            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot create ')->withInput()->withErrors($validator);
            }

            $imageName = '';
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move($this->folderPath, $imageName);
            }


            $slider = Slider::Create([
                "title"=> $request->title,
                "sub_title"=> $request->sub_title,
                "button_one_title" => $request->button_one_title,
                "button_one_url" => $request->button_one_url,
                "button_two_title" => $request->button_two_title,
                "button_two_url" => $request->button_two_url,
                "body" =>$request->body,
                "status"   => ($request->status == 'on') ? 1 : 0,
                "priority" => $request->priority,
                "added_by" => Auth::user()->id,
                "image" => $imageName
            ]);

            return redirect()->route('admin.slider.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {
            return redirect()->route('admin.slider.index')->with('error', 'Something went wrong!!');

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
        $slider = Slider::findorFail($id);
        return view('common::slider.edit',compact('slider'));
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
                'title' => 'required|max:255' . $id, 
                'sub_title'=>'required|max:255',
                'body'=>'required',
            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot edit')->withInput()->withErrors($validator);
            }

            $slider         = Slider::findorFail($id);
            $slider->title  = $request->title;
            $slider->sub_title  = $request->sub_title;
            $slider->body = $request->body;
            $slider->priority = $request->priority; 
            $slider->button_one_title = $request->button_one_title;
            $slider->button_two_title = $request->button_two_title;
            $slider->button_one_url = $request->button_one_url;
            $slider->button_two_url = $request->button_two_url;
            $slider->status = ($request->status == 'on') ? 1 : 0;

            if ($request->hasFile('image')) {
                $old_img=$slider->image;
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move($this->folderPath, $imageName);
                $slider->image = $imageName;
                if($old_img){
                    unlink($this->path.$old_img);
                }
            }
            
            $slider->save();

            return redirect()->route('admin.slider.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception$ex) {

            
            return redirect()->route('admin.slider.index')->with('error', 'Something went wrong!!');

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
            $slider=Slider::where('id', $request->id)->first();
            if($slider->image){
                unlink($this->path.$slider->image);
            }
            $slider->delete();
            return redirect()->route('admin.slider.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception$ex) {

            return redirect()->route('admin.slider.index')->with('error', 'Something went wrong!!');

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

            $result = Slider::query();
            $result = $result->Where(function ($query) use ($keyword) {
                if (null != $keyword) {
                    $query->where('sliders.title', 'LIKE', '%' . $keyword . '%');
                  
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
                    "title"   => $record->title,
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
        } catch (\Exception$e) {
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
