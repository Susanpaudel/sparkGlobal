<?php

namespace GlobalStudio\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    use HasFactory;
    protected $fillable=[
        "title",
        "counter",
        "icon" ,
        "status"
    ];
}
