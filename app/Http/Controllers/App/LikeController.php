<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;

class LikeController extends Controller
{
    public function index(Request $request) {

        if (Auth::user()->verifyLike($request->idea_id)) {
            Auth::user()->dislike($request->idea_id);

        } else {
            $like = Like::create([
                'user_id' => Auth::user()->id,
                'idea_id' => $request->idea_id
            ]);
        }
    }
}
