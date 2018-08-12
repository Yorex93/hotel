<?php

namespace Hotel;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Hotel\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\Hotel\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\Hotel\User role($roles)
 * @method static \Illuminate\Database\Eloquent\Builder|\Hotel\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Hotel\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Hotel\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Hotel\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Hotel\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Hotel\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Hotel\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;

    protected $guard_name = "api";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
