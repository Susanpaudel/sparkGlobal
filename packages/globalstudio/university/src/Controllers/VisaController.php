<?php

namespace GlobalStudio\University\Controllers;

use App\Http\Controllers\Controller;
use DB;
use GlobalStudio\University\Models\Visa;
use GlobalStudio\University\Models\VisaDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('university::visa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visa = Visa::where('status', 1)->get();
        return view('university::visa.create', compact('visa'));
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
                'slug' => 'required|max:255|unique:visa,slug',
                'name' => 'required',
                'icon' => 'required|string'


            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot create')->withInput()->withErrors($validator);
            }
            $image_url = '';
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move(public_path('/images/visa'), $imageName);
                $image_url = 'images/visa/' . $imageName;
            }

            $visa = Visa::Create([
                "name" => $request->name,
                "slug" => $request->slug,
                "content" => $request->content,
                "status" => ($request->status == 'on') ? 1 : 0,
                "image" => $image_url,
                "enrolled" => $request->enrolled,
                "seo_title" => $request->seo_title,
                "seo_keyword" => $request->seo_keyword,
                "seo_description" => $request->seo_description,
                "seo_tags" => $request->seo_tags,
                "icon" =>  $request->icon,

            ]);
            if ($request->document) {
                foreach ($request->document as $document) {
                    $documentName = time() . '.' . $document->extension();
                    $document->move(public_path('/documents/visa'), $documentName);
                    $documentUrl = 'documents/visa/' . $documentName;
                    VisaDocument::create([
                        "document" => $documentUrl,
                        "visa_id" => $visa->id,
                    ]);
                }
            }

            return redirect()->route('admin.visa.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {

            return redirect()->route('admin.visa.index')->with('error', 'Something went wrong!!');
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
        $visa = Visa::findorFail($id);

        return view('university::visa.edit', compact('visa'));
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

            $id = $request->id;
            $validator = Validator::make($request->all(), [
                'slug' => 'required|max:255|unique:visa,slug,' . $id,
                'name' => 'required',
                'icon' => 'required|string'


            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot edit')->withInput()->withErrors($validator);
            }

            $visa = Visa::findorFail($id);
            $visa->name = $request->name;
            $visa->slug = $request->slug;
            $visa->enrolled = $request->enrolled;
            $visa->content = $request->content;
            $visa->status = ($request->status == 'on') ? 1 : 0;
            $visa->seo_tags = $request->seo_tags;
            $visa->seo_title = $request->seo_title;
            $visa->seo_keyword = $request->seo_keyword;
            $visa->seo_description = $request->seo_description;
            $visa->icon = $request->icon;


            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move(public_path('/images/visa'), $imageName);
                $visa->image = 'images/visa/' . $imageName;
            }
            if ($request->document) {
                foreach ($request->document as $document) {
                    $documentName = time() . '.' . $document->extension();
                    $document->move(public_path('/documents/visa'), $documentName);
                    $documentUrl = 'documents/visa/' . $documentName;
                    VisaDocument::create([
                        "document" => $documentUrl,
                        "visa_id" => $visa->id,
                    ]);
                }
            }

            $visa->save();

            return redirect()->route('admin.visa.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {


            return redirect()->route('admin.visa.index')->with('error', 'Something went wrong!!');
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
            Visa::where('id', $request->id)->delete();
            return redirect()->route('admin.visa.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception $ex) {
            return redirect()->route('admin.visa.index')->with('error', 'Something went wrong!!');
        }
    }

    public function search(Request $request)
    {
        try {
            ## Read value
            $draw = intval($request->get('draw'));
            $start = intval($request->get("start"));
            $paginate = intval($request->get("length", env('PAGINATION', 15))); // Rows display per visa

            $visa = intval(($start / $paginate) + 1);
            $request->merge(['visa' => $visa]);

            $columnIndex_arr = $request->get('order');
            $columnName_arr = $request->get('columns');

            $order_arr = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column']; // Column index

            $columnName = $columnName_arr[$columnIndex]['data']; // Column name
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc

            $keyword = $request->keyword;
            ## End Read values

            $result = Visa::query();
            $result = $result->Where(function ($query) use ($keyword) {
                if (null != $keyword) {
                    $query->where('visa.name', 'LIKE', '%' . $keyword . '%');
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
                    "sn" => $sn,
                    "id" => $record->id,
                    "name" => $record->name,
                    "slug" => $record->slug,
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
