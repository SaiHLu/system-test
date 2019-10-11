<?php

namespace App\Http\Controllers;

use App\Events\SendEmailToMemberEvent;
use App\Mail\MemberMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::where([
            ['email', '!=', 'admin@gmail.com']
        ])->paginate(5);
        return view('user.index', compact('users'));
    }

    public function applyList()
    {
        if (Auth::user()->email == 'admin@gmail.com') {
            $users = User::where([
                ['email', '!=', 'admin@gmail.com'],
                ['apply', '=', 1]
            ])->paginate(5);

            return view('user.apply', compact('users'));
        } else {
            return redirect('/login');
        }
    }

    public function update($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        $user->apply = 1;
        $user->save();

        return redirect('/');
    }

    public function randomString()
    {
        if ($this->filterUser()->count() > 1) {
            $user_id = $this->filterUser()->random()->id;
            $total = $this->filterUser()->count();
            $count = 0;

            while ($count < 3 and $total >= 3) {
                $user = User::where('id', '=', $user_id)->where('lottered', '=', 0)->firstOrFail();
                if ($user) {
                    $user->lottered = 1;
                    $user->lottery_code = Str::random(12);
                    $user->save();

                    $user_id = $this->filterUser()->random()->id;
                    $rand_num = rand(1, $this->filterUser()->count());
                    $count++;

                    event(new SendEmailToMemberEvent($user));
                } else {
                    $user_id = $this->filterUser()->random()->id;
                    $rand_num = rand(1, $this->filterUser()->count());
                    $count--;
                }
            }
            return redirect('/winner');
        } else {
            return redirect('/winner');
        }
    }

    public function winner()
    {
        $users = User::where('apply', '=', 1)->where('lottered', '=', 1)->paginate(3);

        return view('user.winner', compact('users'));
    }

    private function filterUser()
    {
        return User::all()->where('apply', '=', 1)->where('lottered', '=', 0);
    }
}
