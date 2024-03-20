<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use DataTables;

class CategoryAjaxController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->categoryRepository->all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('categoryAjax');
    }

    public function create()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
        $data = [
            'name' => $request->name,
            'detail' => $request->detail
        ];

        $this->categoryRepository->createOrUpdate($request->category_id, $data);

        return response()->json(['success' => 'Category saved successfully.']);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $category = $this->categoryRepository->find($id);
        return response()->json($category);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $this->categoryRepository->delete($id);

        return response()->json(['success' => 'Category deleted successfully.']);
    }
}
