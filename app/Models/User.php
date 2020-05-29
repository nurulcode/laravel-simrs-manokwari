<?php

namespace App\Models;

use Sty;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Sty\ResourceModel
{
    use
        Sty\FilterScope,
        Sty\HasPath,
        Sty\HasPolicy,
        Sty\Searchable,
        Sty\MethodOrderable,
        HasApiTokens,
        HasRoles,
        Notifiable,
        RecordsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['active' => 'boolean'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['roles'];

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
