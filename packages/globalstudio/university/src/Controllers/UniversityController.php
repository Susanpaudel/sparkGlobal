<?php

namespace GlobalStudio\University\Controllers;

use App\Http\Controllers\Controller;
use DB;
use GlobalStudio\University\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('university::universities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $visa = Visa::where('status', 1)->get();
        return view('university::universities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        try {
            $validator = Validator::make($request->all(), [
                'slug'  => 'required|max:255|unique:universities,slug',
                'name' => 'required|string',
                'image' => 'required|image',
            ]);

            if ($validator->fails()) {
                dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot create')->withInput()->withErrors($validator);
            }
            $image_url = '';
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move(public_path('/images/university'), $imageName);
                $image_url = 'images/university/' . $imageName;
            }

            if ($request->document) {
                foreach ($request->document as $document) {
                    $documentName = time() . '.' . $document->extension();
                    $document->move(public_path('/documents/university'), $documentName);
                    $documentUrl = 'documents/university/' . $documentName;
                }
            }

            $visa = University::Create([
                "name" => $request->name,
                "slug" => $request->slug,
                "description" => $request->content,
                "status" => ($request->status == 'on') ? 1 : 0,
                "image" => $image_url,
                "pdf" => $documentUrl,
                "seo_title" => $request->seo_title,
                "seo_keyword" => $request->seo_keyword,
                "seo_description" => $request->seo_description,
                "seo_tags" => $request->seo_tags,

            ]);


            return redirect()->route('admin.university.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {
            dd($ex);
            return redirect()->route('admin.university.index')->with('error', 'Something went wrong!!');
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
        $university = University::findorFail($id);

        return view('university::universities.edit', compact('university'));
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
                'image' => 'image',


            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot edit')->withInput()->withErrors($validator);
            }

            $university = University::findorFail($id);
            $university->name = $request->name;
            $university->slug = $request->slug;
            $university->description = $request->content;
            $university->status = ($request->status == 'on') ? 1 : 0;
            $university->seo_tags = $request->seo_tags;
            $university->seo_title = $request->seo_title;
            $university->seo_keyword = $request->seo_keyword;
            $university->seo_description = $request->seo_description;


            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move(public_path('/images/university'), $imageName);
                $university->image = 'images/university/' . $imageName;
            }
            if ($request->document) {
                foreach ($request->document as $document) {
                    $documentName = time() . '.' . $document->extension();
                    $document->move(public_path('/documents/university'), $documentName);
                    $documentUrl = 'documents/university/' . $documentName;
                    $university->pdf = $documentUrl;
                }
            }
// dd($university);
            $university->save();

            return redirect()->route('admin.university.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {


            return redirect()->route('admin.university.index')->with('error', 'Something went wrong!!');
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
            University::where('id', $request->id)->delete();
            return redirect()->route('admin.university.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception $ex) {
            return redirect()->route('admin.university.index')->with('error', 'Something went wrong!!');
        }
    }

    public function search(Request $request)
    {
        try {
            ## Read value
            $draw = intval($request->get('draw'));
            $start = intval($request->get("start"));
            $paginate = intval($request->get("length", env('PAGINATION', 15))); // Rows display per visa

            $university = intval(($start / $paginate) + 1);
            $request->merge(['university' => $university]);

            $columnIndex_arr = $request->get('order');
            $columnName_arr = $request->get('columns');

            $order_arr = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column']; // Column index

            $columnName = $columnName_arr[$columnIndex]['data']; // Column name
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc

            $keyword = $request->keyword;
            ## End Read values

            $result = University::query();
            $result = $result->Where(function ($query) use ($keyword) {
                if (null != $keyword) {
                    $query->where('university.name', 'LIKE', '%' . $keyword . '%');
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
