<?php

namespace App\Http\Controllers;

use App\Exceptions\NoticeException;
use App\Models\Faq;
use App\Models\FaqTags;
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return $this->response('All tags', $tags);
    }

    public function allWithFaqs() {
        $tags = Tag::with('faqsTags')->get();

        return $this->response('With faqs', $tags);
    }

    public function get($id)
    {
        $tag = Tag::findOrFail($id);

        return $this->response('Found', $tag);
    }

    public function create(TagCreateRequest $request)
    {
        $data = [
            'name' => $request->post('name'),
            'faq_id' => $request->post('faq_id'),
        ];


        $newTag = Tag::create($data);

        Faq::findOrFail($data['faq_id'])->tags()->save($newTag);

        return $this->response('Added', $newTag);
    }

    public function update($id, TagUpdateRequest $request)
    {
        $tag = Tag::findOrFail($id);

        $data = [
            'name' => $request->post('name'),
            'faq_id' => $request->post('faq_id'),
        ];

        $updatedTag = $tag->update($data);

        return $this->response('Updated', $updatedTag);
    }

    public function softDelete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return $this->response('Deleted');
    }
}
