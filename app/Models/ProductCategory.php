<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\File;

class ProductCategory extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImage()
    {
        $image_path = $this->attributes['image'];
        $isExists = File::exists(public_path($image_path));
        if ($isExists and $this->attributes['image'] != '') {
            return asset($image_path);
        } else {
            return asset('default/avatar.png');
        }
    }
}
