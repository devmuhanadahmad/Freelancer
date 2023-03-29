<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'type',
        'provider',
        'provider_id',
        'provider_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id')
            ->withDefault();
    }

//relasonship proposal 1 to m
    public function proposal()
    {
        return $this->hasMany(Proposal::class);
    }

    //relasonship contract 1 to m
    public function contract()
    {
        return $this->hasMany(Contract::class);
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
    //relasonship proposalProjected m to m
    public function proposalProjected()
    {
        return $this->belongsToMany(Proposal::class, 'proposals', 'user_id', 'project_id')->withPivot([
            'start_on',
            "end_on",
            "completed_on",
            "status",
            "type",
            "hours",
            "cost",
        ]);
    }

    public static function rules($id = 0)
    {
        return
            [
            'name' => 'required|string|min:5|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => 'required|string',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function scopeFilter(Builder $builder, $filter)
    {
        if ($filter['name'] ?? null) {
            $builder->where('name', $filter['name']);
        }

        if ($filter['status'] ?? null) {
            $builder->where('status', $filter['status']);
        }

    }

    //scope FilterActive
    public function scopeFilterActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }

    //scope FilterNameFreelanserOrJobName
    public function scopeFilterNameFreelanserOrJobName(Builder $builder, $filter)
    {
        if ($filter['name'] ?? null) {
            $builder->where('name', 'LIKE', "%{$filter['name']}%");
        }
    }
}
