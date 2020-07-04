<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable implements CanResetPasswordContract
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom','prenom','numero_tel', 'service', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function regles()
    {
        return $this->hasMany('App\Models\Regle');
    }

    public function inspections()
    {
        return $this->hasMany('App\Models\Inspection');
    }

    public function audits()
    {
        return $this->hasMany('App\Models\Audit');
    }

    public function fichiers()
    {
        return $this->hasMany('App\Models\Fichier');
    }

    public function anomalies()
    {
        return $this->hasMany('App\Models\Anomalie');
    }

    public function actions()
    {
        return $this->hasMany('App\Models\Action');
    }

}
