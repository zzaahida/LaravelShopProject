<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
        'img',
        'account'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function products() {
        return $this->hasMany(Product::class);
    }
    public function productsSize() {
        return $this->belongsToMany(Product::class)
            ->withPivot('size','status','number')
            ->withTimestamps();
    }
    public function productsWithStatus($status) {
        return $this->belongsToMany(Product::class)
            ->wherePivot('status',$status)
            ->withTimestamps()
            ->withPivot('size','status','number');
    }

    public function productsReview(){
        return $this->belongsToMany(Product::class, 'review')
            ->withPivot('review')
            ->withTimestamps();
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }

}
