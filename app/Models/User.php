<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = "user";

    public function role()
    {
        return $this->belongsTo(
            Role::class,
            'fk_id_role',
            'id'
        );
    }

}
