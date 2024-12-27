<?php

namespace GlobalStudio\Common\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GlobalStudio\Common\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use GlobalStudio\Common\Models\BlogCategory;
use GlobalStudio\Common\Models\BlogCategoryPivot;

class BlogController extends Controller
{

    protected $folderPath, $path;
    public function __construct()
    {
        $this->folderPath = 'storage/blog/'; 
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

        return view('common::blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('common::blog.create');
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
                'slug'  => 'required|max:255|unique:blogs,slug',
                'title' => 'required',

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

            $blog = Blog::Create([
                "title"           => $request->title,
                "slug"            => $request->slug,
              
                "short_content"   => $request->short_content,
                "added_by"        => Auth::user()->id,
                "content"         => $request->content,
                "status"          => ($request->status == 'on') ? 1 : 0,
                "image"           => $imageName,
                "seo_title"       => $request->seo_title,
                "seo_keyword"     => $request->seo_keyword,
                "seo_description" => $request->seo_description,
                "tags"            => $request->tags,
            ]);

            return redirect()->route('admin.blog.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {
            return redirect()->route('admin.blog.index')->with('error', 'Something went wrong!!');
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
        $blog  = Blog::findorFail($id);
        $blogs = Blog::where('status', 1)->where('id', '!=', $blog->id)->get();

        // $blog_categories          = BlogCategory::where('status', 1)->get();
        // $selected_blog_categories = Blog::select('blog_categories.*')->leftJoin('blog_categories_pivot', 'blogs.id', 'blog_categories_pivot.blog_id')
        //     ->leftJoin('blog_categories', 'blog_categories.id', 'blog_categories_pivot.blog_category_id')->where('blog_categories.status', 1)->where('blogs.status', 1)->where('blogs.id', $id)->pluck('id')->toArray();

        return view('common::blog.edit', compact('blog'));
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
                'slug'  => 'required|max:255|unique:blogs,slug,' . $id,
                'title' => 'required',

            ]);

            if ($validator->fails()) {
                // dd($validator->errors());
                return redirect()->back()->with('error', 'Couldnot edit')->withInput()->withErrors($validator);
            }

            $blog                  = Blog::findorFail($id);
            $blog->title           = $request->title;
         
            $blog->slug            = $request->slug;
            $blog->short_content   = $request->short_content;
            $blog->content         = $request->content;
            $blog->status          = ($request->status == 'on') ? 1 : 0;
            $blog->tags            = $request->tags;
            $blog->seo_title       = $request->seo_title;
            $blog->seo_keyword     = $request->seo_keyword;
            $blog->seo_description = $request->seo_description;

            if ($request->hasFile('image')) {
                $old_img=$blog->image;
                $imageName = time() . '.' . $request->file('image')->extension();
                $request->image->move($this->folderPath, $imageName);
                $blog->image = $imageName;
                if($old_img){
                    unlink($this->path.$old_img);
                }
            }

            $blog->save();

            return redirect()->route('admin.blog.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {

            dd($ex->getMessage());
            return redirect()->route('admin.blog.index')->with('error', 'Something went wrong!!');
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
            $blog=Blog::where('id', $request->id)->first();
            if($blog->image){
                
                    unlink($this->path.$blog->image);
                
            }
            $blog->delete();
            return redirect()->route('admin.blog.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception $ex) {
            return redirect()->route('admin.blog.index')->with('error', 'Something went wrong!!');
        }
    }

    public function search(Request $request)
    {
        try {
            ## Read value
            $draw     = intval($request->get('draw'));
            $start    = intval($request->get("start"));
            $paginate = intval($request->get("length", env('PAGINATION', 15))); // Rows display per blog

            $blog = intval(($start / $paginate) + 1);
            $request->merge(['blog' => $blog]);

            $columnIndex_arr = $request->get('order');
            $columnName_arr  = $request->get('columns');

            $order_arr  = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column']; // Column index

            $columnName      = $columnName_arr[$columnIndex]['data']; // Column title
            $columnSortOrder = $order_arr[0]['dir']; // asc or desc

            $keyword = $request->keyword;
            ## End Read values

            $result = Blog::query();
            $result = $result->Where(function ($query) use ($keyword) {
                if (null != $keyword) {
                    $query->where('blogs.title', 'LIKE', '%' . $keyword . '%');
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
