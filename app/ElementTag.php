<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElementTag extends Model
{
    protected $fillable = ['title'];

    public function getElements()
    {
        return $this->belongsToMany('App\Element');
    }

}
