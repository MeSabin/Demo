<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $guarded = [];

    protected function imageProduct(): Attribute {
        return Attribute::make(
            get: function() {
                $defaultImage = asset('images/defaultProduct.png');
                if($this->image && Storage::disk('public')->exists('/images/products/' . $this->image)){
                    return Storage::url("/images/products/$this->image");
                }
                else{
                    return $defaultImage;
                }
            },
        );
    }

    public function productcategory(): BelongsTo{
        return $this->belongsTo(ProductCategory::class, 'product_category');
    }
}
