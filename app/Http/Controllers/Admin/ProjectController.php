<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mockery\Expectation;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('project.view');
        $request = Request();
        $projects = Project::with(['user', 'category', 'tag', 'skill'])
            ->latest()
            ->paginate(15, '*', 'page');

        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('project.create');
        $categories = Category::all();
        $project = new Project();
        $tags = [];
        $skills = [];
        return view('admin.project.create', compact('project', 'categories', 'tags', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        Gate::authorize('project.create');
        DB::beginTransaction();
        try {
            $request->merge([
                'slug' => Str::slug($request->post('name')),
            ]);
            $data = $request->except('image');
            if ($request->hasFile('image')) { //check isset image
                $file = $request->file('image'); //return object
                $path = $file->store('project', ['disk' => 'public']);
                $data['image'] = $path;
            }
            $data['user_id'] = Auth::user()->id;
            $project = Project::create($data);

           // $tags = explode(',',  $request->input('tags'));
            $tags = json_decode( $request->input('tags'));
            $project->syncTags($tags);

           // $skills = explode(',', $request->input('skills'));
            $skills = json_decode(  $request->input('skills'));
            $project->syncSkills($skills);
            DB::commit();
            return redirect()->back()->with('success', __("Operation accomplished successfully"));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errore', "Add Project failed ");
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        Gate::authorize('project.update');
        $categories = Category::all();
        $tags = $project->tag()->pluck('name')->toArray();
        $skills = $project->skill()->pluck('name')->toArray();
        return view('admin.project.edit', compact('project', 'categories', 'tags', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        Gate::authorize('project.update');
        $project = Project::findOrFail($id);

        $old_image = $project->image;

        $data = $request->except('image');
        $request->merge(['slug' => Str::slug($request->post('name'))]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('project', ['disk' => 'public']);
            $data['image'] = $path;
        }
        if ($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }
        $project->update($request->all());

        $tags = json_decode(  $request->input('tags'));
        $project->syncTags($tags);

        $skills = json_decode(  $request->input('skills'));
        $project->syncSkills($skills);

        return redirect()->route('project.index')->with('success', __("Operation accomplished successfully"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        Gate::authorize('project.delate');
        $project->delete();

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        return redirect()->route('project.index')->with('success', __("Operation accomplished successfully"));
    }}
