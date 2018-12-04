<?php

namespace App\Http\Controllers\App;

use App\User;
use App\Course;
use App\Institution;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function edit() {
        return view('app.account.edit', [
            'title' => 'Editar Perfil',
            'institutions' => Institution::all(),
            'courses' => Course::all()
        ]);
    }

    public function update(Request $request) {

        $user = Auth::user();

        $user->name = $request->name;
        $user->occupation = $request->occupation;
        $user->birth = $request->birth;
        $user->bio = $request->bio != '' ? $request->bio : '';
        $user->institution_id = $request->institution;
        $user->course_id = $request->course;

        $user->save();

        return redirect('/home');

    }

    public function updateOccupation(Request $request) {
        $user = User::find(Auth::user()->id);
        $user->occupation = $request->occupation;
        $user->save();

        return response()->json(Auth::user());
    }


}
