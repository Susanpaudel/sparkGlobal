<?php

namespace GlobalStudio\Common\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use GlobalStudio\Common\Models\Page;
use GlobalStudio\Common\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;


class PageController extends Controller
{
    protected $folderPath, $path;
    public function __construct()
    {
        $this->folderPath = 'storage/pages/'; 
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

        return view('common::page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::where('status', 1)->get();
        return view('common::page.create', compact('pages'));

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
                'slug' => 'required|max:255|unique:pages,slug',
                'title' => 'required',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Couldnot create')->withInput()->withErrors($validator);
            }

            $page = Page::Create([
                "title" => $request->title,
                "slug" => $request->slug,
                "page_above" => $request->page_above,
                "page_below" => $request->page_below,
                "seo_title" => $request->seo_title,
                "seo_keyword" => $request->seo_keyword,
                "seo_description" => $request->seo_description,
                "seo_tags" => $request->seo_tags,
                "added_by" => Auth::user()->id,
                "status" => ($request->status == 'on') ? 1 : 0,
                "menu" => ($request->menu == 'on') ? 1 : 0,
            ]);
            $i = 0;
            foreach ($request->section_title as $title) {
                $page_content = new PageContent();
                $page_content->page_id = $page->id;
                $page_content->title = $title;
                $page_content->link = $request->link[$i];
                $page_content->content = $request->content[$i];
                $page_content->subtitle = $request->section_subtitle[$i];
                $page_content->text = $request->text[$i];
                if (isset($request->image[$i])) {
                    $imageName = rand(5, 10) . time() . '.' . $request->image[$i]->extension();
                    $request->image[$i]->move($this->folderPath, $imageName);
                    $page_content->image = $imageName;

                } 
                $page_content->save();
                $i++;
            }
            return redirect()->route('admin.page.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {
            return redirect()->route('admin.page.index')->with('error', 'Something went wrong!!');

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
        $page = Page::findorFail($id);
        $page->contents = PageContent::where('page_id',$id)->get();
        $pages = Page::where('status', 1)->where('id', '!=', $page->id)->get();
        return view('common::page.edit', compact('page', 'pages'));
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
                'slug' => 'required|max:255|unique:pages,slug,' . $id,
                'title' => 'required',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Couldnot update')->withInput()->withErrors($validator);
            }

      
            $page = Page::findorFail($id);
            $page->title = $request->title;
            $page->slug = $request->slug;
            $page->page_above = $request->page_above;
            $page->page_below = $request->page_below;
            $page->seo_title = $request->seo_title;
            $page->seo_keyword = $request->seo_keyword;
            $page->seo_description = $request->seo_description;
            $page->seo_tags = $request->seo_tags;
            $page->status = ($request->status == 'on') ? 1 : 0;
            $page->menu = ($request->menu == 'on') ? 1 : 0;

            $i = 0;
            foreach ($request->content_id as $content_id) {
                $page_content = PageContent::where('id',$content_id)->first();
                $page_content->content = $request->content[$i];
                $page_content->link = $request->link[$i];
                $page_content->title = $request->section_title[$i];
                $page_content->subtitle = $request->section_subtitle[$i];
                $page_content->text = $request->text[$i];

                if (isset($request->image[$i])) {
                    $imageName = rand(5, 10) . time() . '.' . $request->image[$i]->extension();
                    $request->image[$i]->move($this->folderPath, $imageName);
                    $page_content->image = $imageName;
                } 
                $page_content->save();
                $i++;
            }
            $page->save();
            return redirect()->route('admin.page.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return redirect()->route('admin.page.index')->with('error', 'Something went wrong!!');

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
            Schema::disableForeignKeyConstraints();
            Page::where('id', $request->id)->delete();
            Schema::enableForeignKeyConstraints();
            return redirect()->route('admin.page.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception $ex) {
            return redirect()->route('admin.page.index')->with('error', 'Something went wrong!!');

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

            $columnName = $columnName_arr[$columnIndex]['data']; // Column title
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc

            $keyword = $request->keyword;
            ## End Read values

            $result = Page::query();
            $result = $result->Where(function ($query) use ($keyword) {
                if (null != $keyword) {
                    $query->where('pages.title', 'LIKE', '%' . $keyword . '%');

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
                    "title" => $record->title,
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
