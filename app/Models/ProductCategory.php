<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProductCategory extends Model
{
    protected $table = 'productcategory';
    protected $guarded = [];

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: function () {
                $defaultImage = '';
                if ($this->image && Storage::disk('public')->exists('/images/product_categories/' . $this->image)) {
                    return Storage::url("/images/product_categories/$this->image");
                } else {
                    return $defaultImage;
                }
            },
        );
    }

    
    public function users(): BelongsTo {
        return $this->belongsTo(User::class,'created_by');
    }
}
