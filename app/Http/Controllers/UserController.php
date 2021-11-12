<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChildRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function createForm(): View
    {
        return view('registration');
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return RedirectResponse
     */
    public function create(CreateUserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = new User();
        $user->fill($data);
        if (isset($data['parent_email'])){
            $parent = User::where('email', $data['parent_email'])->first();
            $user->parent()->associate($parent->id);
        }
        $user->save();

        if ($user->save()) {
            session()->flash('success', 'Registration finished');
        } else {
            session()->flash('error', 'Error registration');
        }
        Auth::login($user);

        return redirect()->route('user.structure');
    }

    /**
     * @return View
     */
    public function loginForm(): View
    {
        return view('login');
    }

    public function login(LoginUserRequest $request): RedirectResponse
    {
        if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ]
        )) {
            Auth::user();
            return redirect()->route('user.structure');
        }

        return redirect()->back()->with('erorr', 'Incorrect login/password');
    }

    /**
     * @return View
     */
    public function showStructure(): View
    {
        $user = Auth::user();
        $children = DB::select("
            with recursive cte (id, email, parent_id, lvl, path) as (
              select     id,
                         email,
                         parent_id,
                         0 lvl,
                         email as path
              from       users
              where      parent_id = ".$user->id."
              union all
              select     p.id,
                         p.email,
                         p.parent_id,
                         cte.lvl + 1,
                         CONCAT(cte.path, ' > ', p.email)
              from       users p
              inner join cte
                      on p.parent_id = cte.id
            )
            select * from cte
            ORDER BY path;
           ");
        return view('structure')->with(['user' => $user, 'children' => $children]);
    }

    public function createFormChild()
    {
        return view('registration-child');
    }

    public function createChild(CreateChildRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = new User();
        $user->fill($data);
        $user['parent_id'] = Auth::user()->id;

        $user->parent()->associate($user['parent_id']);
        $user->save();

        if ($user->save()) {
            session()->flash('success', 'Child registration finished');
        } else {
            session()->flash('error', 'Error child registration');
        }

        return redirect()->route('user.structure');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('user.login.form');
    }
}
