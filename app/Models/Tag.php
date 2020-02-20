<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function faqsTags()
    {
        return $this->belongsToMany(Faq::class, 'faqs_tags', 'tag_id', 'faq_id');
    }

}
