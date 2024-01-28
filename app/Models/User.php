<?php

namespace App\Models;



use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasRoles;




class User extends Authenticatable implements MustVerifyEmail

{

    use HasApiTokens, HasFactory, Notifiable, HasRoles;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name',
        'email',
        'password',
        'active',

    ];



    /**

     * The attributes that should be hidden for serialization.

     *

     * @var array

     */

    protected $hidden = [

        'password',

        'remember_token',

    ];



    /**

     * The attributes that should be cast.

     *

     * @var array

     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];

    public function activeLoans() {
        return $this
            ->loans()
            ->where('is_returned', false)
            ->get();
    }

    public function projectactiveLoans() {
        return $this
            ->projectloans()
            ->where('is_returned', false)
            ->get();
    }

    public function loans(): HasMany {
        return $this->hasMany(Loan::class);
    }

    public function projectloans(): HasMany {
        return $this->hasMany(projectLoan::class);
    }
    public function isAdmin()
    {
        return $this->role === 'مسؤول';
    }
    protected static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            $user->assignRole('مستخدم');
        });
    }



}