<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property int $active
 * @property int $fk_id_role
 * @property int|null $fk_id_branch
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFkIdBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFkIdRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Branch|null $branch
 */
class User extends Authenticatable
{
    protected $table = "user";

    protected $fillable = [
        'name',
        'email',
        'fk_id_role'
    ];

    public function role()
    {
        return $this->belongsTo(
            Role::class,
            'fk_id_role',
            'id'
        );
    }

    public function branch()
    {
        return $this->belongsTo(
            Branch::class,
            'fk_id_branch',
            'id'
        );
    }

    public function hasRole($role)
    {
        if ($this->role()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function isAdmin()
    {
        return $this->fk_id_role == Role::ADMIN;
    }

    public function isBranch()
    {
        return $this->fk_id_role == Role::BRANCH;
    }

}
