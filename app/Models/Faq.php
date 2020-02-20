<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'category_id',
        'question',
        'answer',
        'is_active',
        'sort-weight',
    ];

    //protected $with = ['tags'];

    public function tags(){
        return $this->belongsToMany(
            Tag::class,
            'faqs_tags',
            'faq_id',
            'tag_id'
            );
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
