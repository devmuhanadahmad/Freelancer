<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProposalRequest;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\User;
use App\Notifications\CreateProposalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropsalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $proposals=Proposal::with('project')->latest()->paginate();
       dd($proposals);
       return view('freelancer.proposal.index',compact('proposals'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($project_id)
    {
        $project=Project::findOrFail($project_id);
        $proposals=Proposal::with(['user'])->latest()
        ->paginate(15, '*', 'page');

        if(User::with('proposalProjected')->find($project->id)){
            return redirect()->back()->with([
                'error','you can not submit propsal to this project'
            ]);
        }

        if($project->status !== 'open'){
            return view('front.404');
        }

        $proposal=new Proposal();
        return view('front.showProject',compact('proposal','proposals','project'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$project_id)
    {

        $project=Project::findOrFail($project_id);
        if(Auth::user()){


        if($project->status !== 'open'){
            return view('front.404');
        }

        if(User::with('proposalProjected')->find($project->id)){
            return redirect()->back()->with([
                'error','you can not submit propsal to this project'
            ]);
        }

        $user=Auth::user();
        $request->merge([
            'project_id'=>$project_id,
            'user_id'=>$user->id,
        ]);
        $proposal=Proposal::create($request->all());
        #notification database CreatePrposalNotification

        $user->notify(new CreateProposalNotification($user,$proposal));
        return redirect()->back()->with('success', __("Operation accomplished successfully"));

        }
        return redirect()->back()->with('error', __("Please you should login"));

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
