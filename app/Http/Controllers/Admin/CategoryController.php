<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        if(! Gate::allows('category.view')){
            abort(403);
        }
        */
        Gate::authorize('category.view');
        $request = Request();
        $categories = Category::leftJoin('categories as parent', 'parent.id', '=', 'categories.parent_id')
            ->select('categories.*', 'parent.name as parent_name')
            ->Filter($request->query())
            ->latest()
            ->paginate(15, '*', 'page');
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('category.create');
        $category = new Category();
        $parent = Category::all();
        return view('admin.category.create', compact('category', 'parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Gate::authorize('category.create');
        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);
        $data = $request->except('image');
        if ($request->hasFile('image')) { //check isset image
            $file = $request->file('image'); //return object
            $path = $file->store('categories', ['disk' => 'public']);
            $data['image'] = $path;
        }
        Category::create($data);
        return redirect()->route('category.index')->with('success', __("Operation accomplished successfully"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('category.update');
        $category = Category::findOrFail($id);
        $parent = Category::all();
        return view('admin.category.edit', compact('category', 'parent'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        Gate::authorize('category.update');
        $category = Category::findOrFail($id);

        $old_image = $category->image;

        $data = $request->except('image');
        $request->merge(['slug' => Str::slug($request->post('name'))]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('Categories', ['disk' => 'public']);
            $data['image'] = $path;
        }
        if ($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }
        $category->update($data);
        return redirect()->route('category.index')->with('success', __("Operation accomplished successfully"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Gate::authorize('category.delete');
        $category->delete();

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('category.index')->with('success', __("Operation accomplished successfully"));
    }}
