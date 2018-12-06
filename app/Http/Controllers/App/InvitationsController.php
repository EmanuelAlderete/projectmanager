<?php

namespace App\Http\Controllers\App;

use App\Invitation;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvitationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.projects.invitations.index', [
            'title' => 'Convites',
            'invitations' => Auth::user()->invitations,
        ]);
    }

    public function answerInvite(Request $request) {
        if ($request->answer == "true") {
            $invitation = Invitation::find($request->id);
            $invitation->status = 1;
            $invitation->save();

            $project = Project::find($invitation->project_id);
            $project->teacher_id = $invitation->user_id;
            $project->save();

        } else {
            $invitation = Invitation::find($request->id);
            $invitation->status = 2;
            $invitation->save();
        }

        return redirect('/invitations');
    }
}
