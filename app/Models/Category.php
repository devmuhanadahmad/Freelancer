<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'status',
        'notes',
        'image',
    ];

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                "unique:categories,name,$id",
            ],
            'parent_id' => [
                'nullable', 'int', 'exists:categories,id',
            ],
            'notes' => [
                'nullable', 'string',
            ],

            'image' => [
                'image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
            ],
            'status' => 'required|in:active,inactive',
        ];
    }

    public function parent()
    {
        return $this->belongsTo(Category::class)->withDefault(
            [
                'name' => 'Primare Category',
            ]
        );
    }

    public function child()
    {
        return $this->hasMany(Category::class);

    }

    //scope Filter
    public function scopeFilter(Builder $builder, $filter)
    {
        if ($filter['name'] ?? null) {
            $builder->where('name', 'LIKE', "%{$filter['name']}%");
        }
        if ($filter['category_type'] ?? null) {
            if ($filter['category_type'] == 'active') {
                $builder->whereNull('parent_id');
            }
            if ($filter['category_type'] == 'inactive') {
                $builder->whereNotNull('parent_id');
            }

        }

    }

    //scope FilterActive
    public function scopeFilterActive(Builder $builder)
    {

            $builder->where('status', 'active');

    }

    //Accessors image
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://www.firstcolonyfoundation.org/wp-content/uploads/2022/01/no-photo-available.jpeg';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

}
