<?php

namespace GlobalStudio\Common\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use GlobalStudio\Common\Models\SiteConfig;

class SiteConfigController extends Controller
{
    protected $folderPath, $path;
    public function __construct()
    {
        $this->folderPath = 'storage/setting/'; 
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
    public function index()
    {

        $site_configs = SiteConfig::all();

        return view('common::site-config', compact('site_configs'));
    }

    public function update(Request $request)
    {
        $site_configs = SiteConfig::all();

        foreach ($site_configs as $config) {
            $key = $config->key;

            $model = SiteConfig::where('key', $key)->first();
            if ($model->data_type == "file") {
                if ($request[$key]) {
                    $imageName = rand(5, 10) . time() . '.' . $request[$key]->extension();
                    $request[$key]->move($this->folderPath, $imageName);
                    $model->value = $imageName;
                    $model->save();
                }
            } else {
                $model->value = $request[$key];

                $model->save();
            }
        }
        return redirect()->back()->with('success', "Successfully Updated");
    }
}
