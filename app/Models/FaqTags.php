<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqTags extends Model
{
    protected $fillable = [
        'id',
        'faq_id',
        'tag_id',
    ];
//    public function faqs(){
//        return $this->belongsToMany(Faq::class, 'faqs');
//    }
//
//    public function tags(){
//        return $this->belongsToMany(Tag::class, 'tags');
//    }
}
