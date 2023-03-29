<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "category_id",
        "name",
        'slug',
        "notes",
        "status",
        "type",
        "budget",
        "days_number",
        "image",
    ];

    //valdatiion rules
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
            'category_id' => [
                'nullable', 'int', 'exists:categories,id',
            ],
            'budget' => [
                'required',
            ],
            'days_number' => [
                'required',
            ],
            'notes' => [
                'required', 'string',
            ],

            'image' => [
               'nullable'
            ],
            'status' => 'required|in:open,in-progress,closed',
            'type' => 'required|in:hourly,fixed',
        ];
    }

    //relasonship user 1 to m
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault(
            [
                'name' => "Unknown",
            ]
        );
    }

    //relasonship category 1 to m
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Primary Category',
        ]);
    }

    //relasonship tag m to m
    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }

    //relasonship skill m to m
    public function skill()
    {
        return $this->belongsToMany(Skill::class);
    }
    //scope Filter
    public function scopeFilter(Builder $builder, $filter)
    {
        if ($filter['name'] ?? null) {
            $builder->where('name', 'LIKE', "%{$filter['name']}%");
        }
        if ($filter['status'] ?? null) {
            if ($filter['status'] == 'open') {
                $builder->where('status', 'open');
            }
            if ($filter['status'] == 'closed') {
                $builder->where('status', 'closed');
            }
            if ($filter['status'] == 'in-progress') {
                $builder->where('status', 'in-progress');
            }

        }

    }

      //scope FilterNameProject
      public function scopeFilterNameProject(Builder $builder, $filter)
      {
          if ($filter['name'] ?? null) {
              $builder->where('name', 'LIKE', "%{$filter['name']}%");
          }
      }

    //scope FilterActive
    public function scopeFilterActive(Builder $builder)
    {
        $builder->where('status', 'open');
    }

    //globle scope
    public static function booted()
    {
        static::addGlobalScope('project', function (Builder $builder) {
            $user = Auth::user();
            if ($user && $user->id) {
                $builder->where('user_id', '=', $user->id);
            }

        });

    }
    //Accessors image image_url
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

    public function getNewProjectAttribute()
    {
        return true;

    }

    public  function syncTags(array $tags)
    {
        /*
                $tags_id = [] ;
        foreach($tags as $tag_name){
            $tag=Tag::firstOrCreate(
                [
                    'slug'=>Str::slug($tag_name),
                ],[
                     'name'=>$tag_name
                ]);

                $tags_id[]= $tag->id;
        }

        $this->tag()->sync($tags_id);
*/
        # code...
        $tags_id = [] ;
        foreach($tags as $item){
            $tag=Tag::firstOrCreate(
                [
                    'slug'=>Str::slug($item->value),
                ],[
                     'name'=>$item->value
                ]);

                $tags_id[]= $tag->id;
        }

        $this->tag()->sync($tags_id);
    }

    public  function syncSkills(array $skills)
    {
        # code...
        $skills_id = [] ;
        foreach($skills as $item){
            $skill=Skill::firstOrCreate(
                [
                    'slug'=>Str::slug($item->value),
                ],[
                     'name'=>$item->value
                ]);

                $skills_id[]= $skill->id;
        }

        $this->skill()->sync($skills_id);
    }



}
