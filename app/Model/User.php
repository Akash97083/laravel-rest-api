<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use function Webmozart\Assert\Tests\StaticAnalysis\lower;

/**
 * @property mixed|string verified
 * @property mixed|string admin
 * @method static create(array $requested_data)
 * @method static findOrFail($id)
 */
class User extends Authenticatable
{
    use Notifiable;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = '1';
    const REGULAR_USER = '0';

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin', 'name', 'email', 'password', 'verified', 'verification_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verification_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // its work when user create by model
    // Mutator
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    // its work when user retrieve by model
    // Accessor
    public function getNameAttribute($name)
    {
        return Str::upper($name);
    }

    // its work when user create by model
    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = strtolower($email);
    }

    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER;
    }

    public function isAdmin()
    {
        return $this->admin == User::VERIFIED_USER;
    }

    public static function generateVerificationToken()
    {
        return Str::random(40);
    }
}
