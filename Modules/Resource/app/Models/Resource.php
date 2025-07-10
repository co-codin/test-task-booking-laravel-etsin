<?php

namespace Modules\Resource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Booking\Models\Booking;
use Modules\Resource\Database\Factories\ResourceFactory;

class Resource extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    protected static function newFactory(): ResourceFactory
    {
        return ResourceFactory::new();
    }
}
