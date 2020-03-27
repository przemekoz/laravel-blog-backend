<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ElementTagRelM2M extends Model
{
    protected $fillable = ['element_id', 'elementtag_id'];
}
