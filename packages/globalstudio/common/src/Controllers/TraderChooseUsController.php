<?php

namespace GlobalStudio\Common\Controllers;

use Illuminate\Http\Request;
use GlobalStudio\Common\Models\TraderChooseUs;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TraderChooseUsController extends Controller
{
    public function index(Request $request)
    {

        return view('common::trader_choose_us.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('common::trader_choose_us.create');
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
                'title' => 'required',

            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot create')->withInput()->withErrors($validator);
            }
           
            $trader_choose_us = TraderChooseUs::Create([
                "title"           => $request->title,
                "description"            => $request->description,
                'status'=>($request->status == 'on') ? 1 : 0,
                "icon"   => $request->icon,
            ]);

            return redirect()->route('admin.trader_choose_us.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {
            return redirect()->route('admin.trader_choose_us.index')->with('error', 'Something went wrong!!');
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
        $trader_choose_us  = TraderChooseUs::findorFail($id);
        $trader_choose_uss = TraderChooseUs::where('status', 1)->where('id', '!=', $trader_choose_us->id)->get();

        // $trader_choose_us_categories          = trader_choose_usCategory::where('status', 1)->get();
        // $selected_trader_choose_us_categories = TraderChooseUs::select('trader_choose_us_categories.*')->leftJoin('trader_choose_us_categories_pivot', 'trader_choose_uss.id', 'trader_choose_us_categories_pivot.trader_choose_us_id')
        //     ->leftJoin('trader_choose_us_categories', 'trader_choose_us_categories.id', 'trader_choose_us_categories_pivot.trader_choose_us_category_id')->where('trader_choose_us_categories.status', 1)->where('trader_choose_uss.status', 1)->where('trader_choose_uss.id', $id)->pluck('id')->toArray();

        return view('common::trader_choose_us.edit', compact('trader_choose_us'));
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
                'title' => 'required',

            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot edit')->withInput()->withErrors($validator);
            }

            $trader_choose_us                  = TraderChooseUs::findorFail($id);
            $trader_choose_us->title           = $request->title;
         
            $trader_choose_us->description            = $request->description;
            $trader_choose_us->icon   = $request->icon;
           
            $trader_choose_us->status          = ($request->status == 'on') ? 1 : 0;
            

           

            $trader_choose_us->save();

            return redirect()->route('admin.trader_choose_us.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {

            dd($ex->getMessage());
            return redirect()->route('admin.trader_choose_us.index')->with('error', 'Something went wrong!!');
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
            $trader_choose_us=TraderChooseUs::where('id', $request->id)->first();
            if($trader_choose_us->image){
                
                    unlink($this->path.$trader_choose_us->image);
                
            }
            $trader_choose_us->delete();
            return redirect()->route('admin.trader_choose_us.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception $ex) {
            return redirect()->route('admin.trader_choose_us.index')->with('error', 'Something went wrong!!');
        }
    }

    public function search(Request $request)
    {
        try {
            ## Read value
            $draw     = intval($request->get('draw'));
            $start    = intval($request->get("start"));
            $paginate = intval($request->get("length", env('PAGINATION', 15))); // Rows display per trader_choose_us

            $trader_choose_us = intval(($start / $paginate) + 1);
            $request->merge(['trader_choose_us' => $trader_choose_us]);

            $columnIndex_arr = $request->get('order');
            $columnName_arr  = $request->get('columns');

            $order_arr  = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column']; // Column index

            $columnName      = $columnName_arr[$columnIndex]['data']; // Column title
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc

            $keyword = $request->keyword;
            ## End Read values

            $result = TraderChooseUs::query();
            $result = $result->Where(function ($query) use ($keyword) {
                if (null != $keyword) {
                    $query->where('trader_choose_us.title', 'LIKE', '%' . $keyword . '%');
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
                    "title"  => $record->title,
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
