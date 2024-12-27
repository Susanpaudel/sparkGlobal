<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use GlobalStudio\Common\Models\Blog;
use GlobalStudio\Common\Models\Page;
use GlobalStudio\Common\Models\Team;
use GlobalStudio\Common\Models\Slider;
use GlobalStudio\Common\Models\Service;
use GlobalStudio\University\Models\Visa;
use GlobalStudio\University\Models\Course;
use GlobalStudio\Common\Models\Testimonial;
use GlobalStudio\Common\Models\WhyChooseUs;
use GlobalStudio\University\Models\University;
use GlobalStudio\Common\Models\ServiceCategory;
use GlobalStudio\University\Models\Destination;


class Helper
{
    public static function getSliders()
    {
        $sliders = Slider::query()
            ->where('status', 1)
            ->orderBy('priority', 'ASC')
            ->get(['title', 'body', 'image','sub_title','button_one_title','button_one_url','button_two_title','button_two_url']);

        return $sliders;
    }

    public static function getRecentBlogs()
    {
        $blogs = Blog::query()
            ->where('status', 1)
            ->orderBy('views', 'DESC')
            ->limit(2)
            ->get();

        return $blogs;
    }

    public static function getServices()
    {
        $services = Service::query()
            ->where('status', 1)
            ->orderBy('priority', 'ASC')
            ->get();

        return $services;
    }


    public static function getPages()
    {
        $pages = Page::query()
            ->where('status', 1)->where('menu', 1)->get();
        return $pages;
    }
    public static function getBlogs()
    {
        $blogs = Blog::query()
            ->where('status', 1)
            ->orderBy('updated_at', 'DESC')
            ->paginate(6);

        return $blogs;
    }

    public static function getWhyChooseUs()
    {
        $whys = WhyChooseUs::query()
            ->where('status', 1)
            ->orderBy('updated_at', 'DESC')
            ->get();

        return $whys;
    }

    public static function getTeam($position)
    {
        $teams = Team::query()
            ->where('status', 1)
            ->orderBy('created_at', 'ASC')
            ->where('is_top',$position)
            ->get();
        return $teams;
    }
    
   

    public static function getConfigValue($key)
    {
        return DB::table('site_config')->where('key', $key)->value('value');
    }
  


    
}
