<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title','content','price','category_id','user_id','img', 'cost'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function usersSize() {
        return $this->belongsToMany(User::class)
            ->withPivot('size','status','number')
            ->withTimestamps();
    }

    public function usersReview(){
        return $this->belongsToMany(User::class, 'review')
            ->withPivot('review')
            ->withTimestamps();
    }
}

