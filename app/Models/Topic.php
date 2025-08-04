<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    
    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function problems(){
        return $this->hasMany(Problem::class);
    }
}
