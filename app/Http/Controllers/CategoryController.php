<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(): View
    {
        $categories =  $this->categoryRepository->allCategories();

        return view('categories.index', compact('categories'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {

        return view('categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->categoryRepository->storeCategory($request->all());

        return redirect()->route('categories.index')->with('success', 'Category Created Successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id): View
    {
        $category = $this->categoryRepository->findCategory($id);

        return view('categories.create', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $request_data =  $request->all();

        $request_data['category_id'] = $category->id;

        $this->categoryRepository->updateCategory($request_data);

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully');
    }


    public function destroy(Category $category): RedirectResponse
    {
        $this->categoryRepository->destroyCategory([
            ['id', $category->id]
        ]);
        return redirect()->route('categories.index')->with('success', 'Category Delete Successfully');
    }
}
