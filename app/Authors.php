<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $fillable = ['author_name', 'date_of_borth', 'author_address'];
}
