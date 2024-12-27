<?php

namespace GlobalStudio\Common\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use GlobalStudio\Common\Models\Service;
use Illuminate\Support\Facades\Validator;
use GlobalStudio\Common\Models\ServicePrice;
use GlobalStudio\Common\Models\ServiceContent;
use GlobalStudio\Common\Models\TraderChooseUs;
use GlobalStudio\Common\Models\ServiceCategory;
use GlobalStudio\Common\Models\ServiceWorkTime;

class ServiceController extends Controller
{
    protected $folderPath, $path;
    public function __construct()
    {
        $this->folderPath = 'storage/service/'; 
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
    
     public function index(){
       return view('common::service.index');
        
    }

     public function create(){
        $chooses=TraderChooseUs::where('status',1)->get();
      return view('common::service.create',compact('chooses'));
     }

   
    public function store(Request $request)
{
    // Validate the main service data and the repeater fields
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'slug'=>'required|unique:services,slug',
        'short_content' => 'required',
        'content' => 'required',
        'image'=>'required',
        'icon'=>'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    DB::beginTransaction(); // Start transaction

    try {
        // Handle image upload
        $imageName = '';
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->image->move($this->folderPath, $imageName);
          
        }

        // Create the main service entry
        $service = Service::create([
            "title" => $request->title,
            "short_content" => $request->short_content,
            "content" => $request->content,
            "priority" => $request->priority,
            "icon" => $request->icon,
            "trader_choose_us_id" => json_encode($request->trader_content),
            "client_benefit_title"=>json_encode($request->benefit_title),
            "client_benefit_description"=>json_encode($request->benefit_description),
            "seo_title" => $request->seo_title,
            "seo_keyword" => $request->seo_keyword,
            "seo_description" => $request->seo_description,
            "seo_tags" => $request->seo_tags,
            "status" => ($request->status == 'on') ? 1 : 0,
            "slug" => $request->slug,
            "image" => $imageName,
        ]);
        
        DB::commit(); // Commit transaction
        return redirect()->route('admin.service.index')->with('success', 'Service created successfully!');

    } catch (\Exception $ex) {
        DB::rollBack(); // Rollback transaction on error
     dd($ex->getMessage());
        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to create service. Please try again.');
    }
}
    
    
    public function show($id)
    {
        $service  = Service::findorFail($id);
        return view('common::service.view', compact('service'));
    }


     public function search(Request $request)
    {
        try
        {
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

            $result = Service::query();
            $result = $result->Where(function ($query) use ($keyword)
            {
                if (null != $keyword)
                {
                    $query->where('services.title', 'LIKE', '%' . $keyword . '%');
                }
            })
                ->latest()
                ->paginate($paginate);
            $data_arr = array();

            $sn = 1;
            foreach ($result as $record)
            {
                $data_arr[] = array(
                    "sn"     => $sn,
                    "id"     => $record->id,
                    "title"   => $record->title,
                    "status"   => $record->status,
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
        }
        catch (\Exception $e)
        {
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


    public function edit($id)
    {
         $service = Service::findOrFail($id);
         $chooses=TraderChooseUs::where('status',1)->get();
        if ($service) {
            return view('common::service.edit', compact('service','chooses'));
        } else {
            return redirect()->back();
        }
    }
    

    public function update(Request $request, $id)
{
    
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'slug'=>'required|unique:services,slug,'.$id,
        'short_content' => 'required',
        'content' => 'required',
      
        'icon'=>'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    try {
        // Update the main service
        $service = Service::findOrFail($id);

        // Check if there is an old image and delete it
        if ($request->hasFile('image')) {
            $old_img=$service->image;
           
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move($this->folderPath, $imageName); 
             // Delete the old image if it exists
             if ($old_img) {
                unlink($this->folderPath.$old_img);
            }
        } else {
            // Retain the old image if no new image is uploaded
            $imageName = $service->image;
        }

        // Update other service fields
        $service->update([
            "title" => $request->title,
            "short_content" => $request->short_content,
            "content" => $request->content,
            "priority" => $request->priority,
            "icon" => $request->icon,
            "trader_choose_us_id" => json_encode($request->trader_content),
            "client_benefit_title"=>json_encode($request->benefit_title),
            "client_benefit_description"=>json_encode($request->benefit_description),
            "seo_title" => $request->seo_title,
            "seo_keyword" => $request->seo_keyword,
            "seo_description" => $request->seo_description,
            "seo_tags" => $request->seo_tags,
            "status" => ($request->status == 'on') ? 1 : 0,
            "slug" => $request->slug,
            'image' => $imageName
        ]);


        return redirect()->route('admin.service.index')->with('success', 'Service updated successfully!');
    } catch (\Exception $ex) {
        return redirect()->back()->with('error', 'Error: ' . $ex->getMessage());
    }
}

public function priorityUpdate(Request $request, $id){

    $service=Service::findOrFail($id);

        $service->update([
            'title' => $request->title,
          
            'priority' => $request->priority,

        ]);

        return redirect()->back()->with('success', 'Priority updated successfully!');

}

    public function delete(Request $request)
    {
        try
        {
            $service = Service::findOrFail($request->id);

            // Delete related service contents
            if ($service->image) {
                unlink($this->folderPath.$service->image);
            }
    
            // Delete the service itself
            $service->delete();
            return redirect()->route('admin.service.index')->with('success', 'Successfully Deleted!!');
        }
        catch (\Exception $ex)
        {
            return redirect()->route('admin.service.index')->with('error', $ex->getMessage());
        }
    }
     }

