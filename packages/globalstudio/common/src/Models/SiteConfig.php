<?php

namespace GlobalStudio\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SiteConfig extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $table = 'site_config';

}
