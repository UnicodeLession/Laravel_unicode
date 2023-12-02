<?php

namespace Modules\Category\src\Http\Controllers;

use Modules\Category\src\Repositories\CategoryRepository;
use Modules\Category\src\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
class CategoryController extends Controller{

    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index(){
        $pageTitle = 'Danh Sách Danh Mục';
        return view('category::lists', compact('pageTitle'));
    }
    public function data(){
        $categories = $this->categoryRepo->getCategories();
        $categories = DataTables::of($categories)
            // ->addColumn('edit', function ($category) {
            //     return '<a href="'.route('admin.categories.edit', $category).'" class="btn btn-warning">Sửa</a>';
            // })
            // ->addColumn('delete', function ($category) {
            //     return '<a href="'.route('admin.categories.delete', $category).'" class="btn btn-danger delete-action">Xóa</a>';
            // })
            // ->addColumn('link', function ($category) {
            //     return '<a href="" class="btn btn-primary">Xem</a>';
            // })
            // ->editColumn('created_at', function ($category) {
            //     return Carbon::parse($category->created_at)->format('d/m/Y H:i:s');
            // })

            // ->rawColumns(['edit', 'delete', 'link'])
            ->toArray();


        $categories['data'] = $this->getCategoriesTable($categories['data']);

        return $categories;
    }

    public function getCategoriesTable($categories, $char='', &$result=[])
    {
        if (!empty($categories)) {
            foreach ($categories as $key => $category) {
                $row = $category;
                $row['name'] = $char.$row['name'];
                $row['edit'] = '<a href="'.route('admin.categories.edit', $category['id']).'" class="btn btn-warning">Sửa</a>';
                $row['delete'] = '<a href="'.route('admin.categories.delete', $category['id']).'" class="btn btn-danger">Xóa</a>';
                $row['link'] = '<a target="_blank" href="/danh-muc/'.$category['slug'].'" class="btn btn-primary">Xem</a>';
                $row['created_at'] = Carbon::parse($category['created_at'])->format('d/m/Y H:i:s');
                unset($row['sub_categories']);
                unset($row['updated_at']);
                $result[] = $row;
                if (!empty($category['sub_categories'])) {
                    $this->getCategoriesTable($category['sub_categories'], $char.'--| ', $result);
                }
            }
        }

        return $result;
    }
    public function create(){
        $pageTitle = "Thêm Danh Mục";
        $categories = $this->categoryRepo->getAllCategories();
        return view('category::add', compact('pageTitle','categories'));
    }
    public function store(CategoryRequest $request){
        $this->categoryRepo->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);
        return redirect()->route('admin.categories.index')
            ->with('msg',
                __('messages.success',
                    [
                        'action' => 'Thêm',
                        'attribute' => 'Danh Mục'
                    ]
                )
            )
            ->with('type', 'success');
    }
    public function edit($id){
        $category = $this->categoryRepo->find($id);
        $categories = $this->categoryRepo->getAllCategories();
        if(!$category) {
            abort(404);
        }
        $pageTitle = "Cập Nhật Danh Mục";
        return view('category::edit', compact('pageTitle','categories','category'));
    }
    public function update($id, CategoryRequest $request){
        $data = $request->except('_token');
;        $this->categoryRepo->update($id, $data);
        return back()
            ->with('msg', __('messages.success', ['action' => 'Cập Nhật', 'attribute' => 'Danh Mục']))
            ->with('type', 'success');
    }
    public function delete($id){
        $this->categoryRepo->delete($id);
        return back()->with('msg', __('messages.success',
            ['action' => 'Xóa', 'attribute' => 'Danh Mục']))
            ->with('type', 'success');
    }
}
