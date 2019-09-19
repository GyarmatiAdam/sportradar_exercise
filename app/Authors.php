<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Authors extends Model
{
    protected $fillable = ['name', 'date_of_birth', 'address'];
    
    public function books()
    {
        return $this->hasMany(Books::class, 'authors_id');
    }
}
