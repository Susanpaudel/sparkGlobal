<?php

namespace GlobalStudio\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderChooseUs extends Model
{
    use HasFactory;
    protected $fillable=[
        'title','description','icon','status'
    ];
}
