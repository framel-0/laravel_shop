<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use App\Repository\ICategoryRepository;
use App\Traits\HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    use HttpResponse;

    private $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoriesResource::collection(
            $this->categoryRepository->all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Category\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $request->validated($request->all());

        $category = $this->categoryRepository->create([
            'description' => $request->description,
        ]);

        return $this->success(new CategoriesResource($category), null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // $category = $this->categoryRepository->findById($category->name);

        if (is_null($category)) {
            return $this->error(null, 'Category Not Found', Response::HTTP_NOT_FOUND);
        }

        return $this->success(new CategoriesResource($category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->validated($request->all());

        $category = $this->categoryRepository->findById($category->id);

        if (is_null($category)) {
            return $this->error(null, 'Category Not Found', Response::HTTP_NOT_FOUND);
        }

        $category->description = is_null($request->description) ? $category->description : $request->description;

        $result = $this->categoryRepository->update($category->id, $category->toArray());

        if (is_null($result)) {
            return $this->error(null, 'Failed', Response::HTTP_NOT_MODIFIED);
        }

        return $this->success(($category->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id)
    {
        $category = $this->categoryRepository->findById($category_id);

        if (is_null($category)) {
            return $this->error(null, 'Category Not Found', Response::HTTP_NOT_FOUND);
        }

        $category->delete();

        return $this->success(null, 'Category Deleted Successfully', Response::HTTP_NO_CONTENT);
    }
}
