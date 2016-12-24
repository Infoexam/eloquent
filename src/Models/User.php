<?php

namespace Infoexam\Eloquent\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['passed_at'];

    /**
     * Get the user's password.
     *
     * @param string $value
     *
     * @return string
     */
    public function getPasswordAttribute($value)
    {
        return decrypt($value);
    }

    /**
     * Set the user's password.
     *
     * @param string $value
     *
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = encrypt($value);
    }

    /**
     * Get the department that belongs to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Category::class, 'department_id');
    }

    /**
     * Get the grade that belongs to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Category::class, 'grade_id');
    }

    /**
     * Get the certificates for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Get the receipts for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    /**
     * Get the applies for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applies()
    {
        return $this->hasMany(Apply::class);
    }

    /**
     * Check the user has the given roles.
     *
     * @param string|array $role
     *
     * @return bool
     */
    public function own($role)
    {
        if (! $this->exists) {
            return false;
        }

        if (is_array($role)) {
            return in_array($this->getAttribute('role'), $role, true);
        }

        return $this->getAttribute('role') === $role;
    }
}
