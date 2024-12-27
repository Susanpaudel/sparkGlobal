<?php

namespace GlobalStudio\Common\Models;

use Illuminate\Database\Eloquent\Model;
use GlobalStudio\Common\Models\PageContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Page extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function pageContents(){
        return $this->hasMany(PageContent::class,'page_id','id');
    }
}
