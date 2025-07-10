<?php

namespace Modules\Resource\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Resource\Database\Factories\ResourceFactory;

class Resource extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): ResourceFactory
    // {
    //     // return ResourceFactory::new();
    // }
}
