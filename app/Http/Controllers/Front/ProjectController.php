<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
class ProjectController extends Controller
{
    public function index()
    {
        $request=Request();
        //show all project active
        $projects = Project::FilterActive()->with(['user', 'category', 'tag'])
            ->FilterNameProject($request->query())
            ->latest()
            ->paginate(12, '*', 'page');
        $parentCategories = Category::whereNull('parent_id')->get();
        $childCategories = Category::whereNotNull('parent_id')->get();
        return view('front.project', compact('projects', 'parentCategories', 'childCategories'));
    }

    public function create()
    {
        $categories = Category::all();
        $project = new Project();
        $tags = [];
        $skills = [];
        return view('front.addProject', compact('project', 'categories', 'tags', 'skills'));
    }

    public function store(ProjectRequest $request)
    {
        $userAuth=Auth::user();
        if( $userAuth){

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

            return redirect()->back()->with('success', __("Operation accomplished successfully"));

        }
        return redirect()->back()->with('error', __("You shoud login "));

    }


    public function show()
    {
        $request = Request();

        //show all my project
        $projects = Project::with(['user', 'category', 'tag', 'skill'])
            ->FilterNameProject($request->query())
            ->latest()
            ->paginate(6, '*', 'page');

        return view('front.myProject', compact('projects'));
    }



    public function contactUs()
    {
        return view('front.contactUs');
    }
}
