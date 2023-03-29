<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "project_id",
        "proposal_id",
        'start_on',
        "end_on",
        "completed_on",
        "status",
        "type",
        "hours",
        "cost",

    ];


    protected $casts = [
        'start_on' => 'datetime', 'end_on' => 'datetime', 'completed_on' => 'datetime',
    ];

//valdatiion rules
    public static function rules()
    {
        return [
            'user_id' => [
                'nullable', 'int', 'exists:users,id',
            ],
            'project_id' => [
                'nullable', 'int', 'exists:projects,id',
            ],
            'proposal_id' => [
                'nullable', 'int', 'exists:proposals,id',
            ],
            'start_on' => [
                'required',
            ],
            'end_on' => [
                'required',
            ],
            'completed_on' => [
                'nullable',
            ],
            'hours' => [
                'nullable',
            ],
            'cost' => [
                'required',
            ],
            'status' => 'required|in:active,completed,terminated',
            'type' => 'required|in:fixed,hourly',
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
    public function proposal()
    {
        return $this->belongsTo(Proposal::class)->withDefault();
    }

//scope Filter
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
