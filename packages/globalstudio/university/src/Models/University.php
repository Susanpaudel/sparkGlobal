<?php

namespace GlobalStudio\University\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class University extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'universities';
}
