<?php

namespace App\Http\Controllers;

use App\Exceptions\NoticeException;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return $this->response('All categories', $categories);
    }

    public function allWithQuestions()
    {
        $categories = Category::with('faqs.tags')->get();

        return $this->response('All categories with FAQs', compact('categories'));
    }

    public function get($id)
    {
        $category = Category::findOrFail($id);
        return $this->response('Category with searching id', $category);
    }

    public function create(CategoryCreateRequest $request)
    {
        $data = [
            'name' => $request->post('name'),
            'is_active' => $request->post('is_active'),
            'sort_weight' => $request->post('sort_weight'),
            'icon_url' => $request->post('icon_url'),
        ];

        $newCategory = Category::create($data);
        if (!$newCategory->save()) {
            throw new NoticeException('Creation failed');
        }

        return $this->response('New category', $newCategory);
    }

    public function update($id, CategoryUpdateRequest $request)
    {
        $category = Category::findOrFail($id);

        $data = [
            'name' => $request->post('name'),
            'is_active' => $request->post('is_active'),
            'sort_weight' => $request->post('sort_weight'),
            'icon_url' => $request->post('icon_url'),
        ];

        $category->update($data);

        return $this->response('Updated category', $category);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return $this->response('All categories');
    }
}
