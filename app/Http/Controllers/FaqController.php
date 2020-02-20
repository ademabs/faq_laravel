<?php

namespace App\Http\Controllers;

use App\Exceptions\NoticeException;
use App\Http\Requests\FaqCreateRequest;
use App\Http\Requests\FaqUpdateRequest;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $questions = Faq::all();

        return $this->response('All questions', $questions);
    }

    public function allWithTags(){
        $questions = Faq::with('tags')->get();

        return $this->response('Questions with tags', $questions);
    }


    public function get($id)
    {
        $question = Faq::find($id);

        return $this->response('Found', $question);
    }

    public function create(FaqCreateRequest $request)
    {
        $data = [
            'category_id' => $request->post('category_id'),
            'question' => $request->post('question'),
            'answer' => $request->post('answer'),
            'is_active' => $request->post('is_active'),
            'sort_weight' => $request->post('sort_weight'),
        ];

        $newQuestion = Faq::create($data);

        if (!$newQuestion->save()) {
            throw new NoticeException('Creation failed');
        }

        return $this->response('Added', $newQuestion);
    }

    public function update($id, FaqUpdateRequest $request)
    {
        $question = Faq::find($id);

        $data = [
            'category_id' => $request->post('category_id'),
            'question' => $request->post('question'),
            'answer' => $request->post('answer'),
            'is_active' => $request->post('is_active'),
            'sort_weight' => $request->post('sort-weight'),
        ];

        $updatedQuestion = $question->update($data);

        return $this->response('Updated', $updatedQuestion);
    }

    public function delete($id)
    {
        $question = Faq::find($id);

        $question->delete();

        return $this->response('Deleted');
    }
    //
}
