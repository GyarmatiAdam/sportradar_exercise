<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = ['name', 'release_date','authors_id'];

    public function author()
    {
        return $this->belongsTo(Authors::class, 'authors_id');
    }
}
