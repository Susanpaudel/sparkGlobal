<?php

namespace GlobalStudio\University\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use GlobalStudio\University\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('university::destination.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinations = Destination::where('status', 1)->get();
        return view('university::destination.create', compact('destinations'));
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
                'slug'  => 'required|max:255|unique:destinations,slug',
                'name' => 'required',

            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot create')->withInput()->withErrors($validator);
            }
            $image_url = '';
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move(public_path('/images/destinations'), $imageName);
                $image_url = 'images/destinations/' . $imageName;
            }

            $destination = Destination::Create([
                "name"            => $request->name,
                "slug"            => $request->slug,
                "content"     => $request->content,
                "status"          => ($request->status == 'on') ? 1 : 0,
                "image"           => $image_url,
                "enrolled"      => $request->enrolled,
                "seo_title"       => $request->seo_title,
                "seo_keyword"     => $request->seo_keyword,
                "seo_description" => $request->seo_description,
                "seo_tags"        => $request->seo_tags,
            ]);

            return redirect()->route('admin.destination.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {
            
            return redirect()->route('admin.destination.index')->with('error', 'Something went wrong!!');
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
        $destination  = Destination::findorFail($id);
        return view('university::destination.edit', compact('destination'));
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
            // dd($request->all());

            $id        = $request->id;
            $validator = Validator::make($request->all(), [
                'slug'  => 'required|max:255|unique:destinations,slug,' . $id,
                'name' => 'required',

            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot edit')->withInput()->withErrors($validator);
            }

            $destination                  = Destination::findorFail($id);
            $destination->name            = $request->name;
            $destination->slug            = $request->slug;
            $destination->enrolled      = $request->enrolled;
            $destination->content     = $request->content;
            $destination->status          = ($request->status == 'on') ? 1 : 0;
            $destination->seo_tags        = $request->seo_tags;
            $destination->seo_title       = $request->seo_title;
            $destination->seo_keyword     = $request->seo_keyword;
            $destination->seo_description = $request->seo_description;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move(public_path('/images/destinations'), $imageName);
                $destination->image = 'images/destinations/' . $imageName;
            }
            $destination->save();

            return redirect()->route('admin.destination.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {
            

            return redirect()->route('admin.destination.index')->with('error', 'Something went wrong!!');
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
            Destination::where('id', $request->id)->delete();
            return redirect()->route('admin.destination.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception $ex) {
            return redirect()->route('admin.destination.index')->with('error', 'Something went wrong!!');
        }
    }

    public function search(Request $request)
    {
        try {
            ## Read value
            $draw     = intval($request->get('draw'));
            $start    = intval($request->get("start"));
            $paginate = intval($request->get("length", env('PAGINATION', 15))); // Rows display per destination

            $destination = intval(($start / $paginate) + 1);
            $request->merge(['destination' => $destination]);

            $columnIndex_arr = $request->get('order');
            $columnName_arr  = $request->get('columns');

            $order_arr  = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column']; // Column index

            $columnName      = $columnName_arr[$columnIndex]['data']; // Column name
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc

            $keyword = $request->keyword;
            ## End Read values

            $result = Destination::query();
            $result = $result->Where(function ($query) use ($keyword) {
                if (null != $keyword) {
                    $query->where('destinations.name', 'LIKE', '%' . $keyword . '%');
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
                    "name"  => $record->name,
                    "slug"   => $record->slug,
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
