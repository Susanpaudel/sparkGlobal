<?php

namespace App\Helpers;

use GlobalStudio\Common\Models\Activity;
use GlobalStudio\Common\Models\Event;
use GlobalStudio\Common\Models\Blog;
use GlobalStudio\Common\Models\SiteConfig;
use GlobalStudio\Ecommerce\Models\Product;
use Illuminate\Support\Facades\DB;


class MyHelper
{

    public static function getFooterBlog()
    {
        $blogItems = Blog::orderBy('created_at', 'desc')->take(2)->get();
        return $blogItems;
    }

    public static function getSiteConfig($key)
    {
        return DB::table('site_config')->where('key', $key)->value('value');
    }

    public static function getProduct()
    {
        $products = Product::orderBy('created_at', 'desc')->take(2)->get();
        return $products;
    }
}
