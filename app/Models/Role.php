<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function permissions(): BelongsToMany {
        return $this->belongsToMany(Permission::class, 'role_permission', 'permission_id', 'role_id');
    }
}
