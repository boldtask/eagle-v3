<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Warranty extends Model
{
    protected $fillable = [
        'uuid',
        'status',
        'is_hoa',
        'hoa_name',
        'tile_profile',
        'tile_color',
        'owner_id',
        'install_type',
        'addresses',
        'installer_info',
        'installed_at',
    ];

    protected $appends = [
        'owner_email',
    ];

    protected $casts = [
        'is_hoa'         => 'boolean',
        'addresses'      => 'array',
        'installer_info' => 'array',
        'installed_at'   => 'date',
    ];

    /**
     * @return string|null
     */
    public function getOwnerEmailAttribute(): ?string
    {
        return $this->owner ? $this->owner->email : null;
    }

    /**
     * @return HasOne
     */
    public function owner(): HasOne
    {
        return $this->hasOne(Owner::class, 'id');
    }
}
