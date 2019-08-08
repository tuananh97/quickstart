<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use App\Notifications\UserFollowed;
use Auth;

class FollowController extends Controller
{
    public function index()
    {
        return view('index2', [
            'users' => User::where('id', '!=', Auth::id())->get()
        ]);
    }

    public function follow(User $user)
    {
        if (!Auth::user()->isFollowing($user->id)) {
            // Create a new follow instance for the authenticated user
            Auth::user()->follows()->create([
                'target_id' => $user->id,
            ]);
            // add this to send a notification
            $user->notify(new UserFollowed(Auth::user()));

            return back()->with('success', 'You are now friends with '. $user->name);
        } else {
            return back()->with('error', 'You are already following this person');
        }

    }

    public function unfollow(User $user)
    {
        if (Auth::user()->isFollowing($user->id)) {
            $follow = Auth::user()->follows()->where('target_id', $user->id)->first();
            $follow->delete();

            return back()->with('success', 'You are no longer friends with '. $user->name);
        } else {
            return back()->with('error', 'You are not following this person');
        }
    }
}
