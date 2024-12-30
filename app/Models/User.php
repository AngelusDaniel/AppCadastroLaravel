<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
    protected $hidden = [
        "password",
    ];

    public function clientes()
    {
        return $this->hasMany(Cadastro::class);
    }
}
