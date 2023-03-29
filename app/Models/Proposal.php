<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "project_id",
        'description',
        "cost",
        "duration",
        "status",
        "duration_unit",

    ];

    //valdatiion rules
    public static function rules()
    {
        return [
            'description' => [
                'required',
                'string',
                'min:10',
            ],
            'user_id' => [
                'nullable', 'int', 'exists:users,id',
            ],
            'project_id' => [
                'nullable', 'int', 'exists:projects,id',
            ],
            'cost' => [
                'required',
            ],
            'duration' => [
                'required',
            ],
            'status' => 'required|in:pending,accepted,declined',
            'duration_unit' => 'required|in:day,week,month,year',
        ];
    }

    //relasonship user 1 to m
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    //relasonship project 1 to m
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    //relasonship project 1 to 1
    public function contract()
    {
        return $this->hasOne(Contract::class)->withDefault();
    }

    //scope Filter name & status
    public function scopeFilter(Builder $builder, $filter)
    {
        if ($filter['name'] ?? null) {
            $builder->where('name', 'LIKE', "%{$filter['name']}%");
        }
        if ($filter['status'] ?? null) {
            if ($filter['status'] == 'pending') {
                $builder->where('status', 'pending');
            }
            if ($filter['status'] == 'accepted') {
                $builder->where('status', 'accepted');
            }
            if ($filter['status'] == 'declined') {
                $builder->where('status', 'declined');
            }

        }

    }

}
