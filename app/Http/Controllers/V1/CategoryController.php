<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CategoryRequest;
use App\Http\Resources\V1\CategoryResource;
use App\Models\V1\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $categories = Category::where('parent_id', null)->with('children')->get();
        return $this->apiResult(__('messages.index_method', ['name' => __('values.category')]),
            CategoryResource::collection($categories)
        );
    }

    public function store(CategoryRequest $categoryRequest)
    {
        $category = Category::create($categoryRequest->only('title', 'slug', 'is_active', 'parent_id'));
        return $this->apiResult(__('messages.store_method', ['name' => __('category')]),
            new CategoryResource($category)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
