<?php

namespace App;

use App\ElementTag;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = ['title', 'description'];

    public function tags()
    {
        return $this->belongsToMany('App\ElementTag', 'element_tag_rel_m2_m_s', 'element_id', 'elementtag_id');
    }
}
