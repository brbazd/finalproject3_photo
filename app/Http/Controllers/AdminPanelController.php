<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminPanelController extends Controller
{
    public function index()
    {
        if(Gate::denies("check-if-user-is-admin"))
        {
            return redirect()->back();
        }

        $users = User::paginate(15);

        return view('admin.index',compact('users'));
    }

    public function update(Request $request, User $user)
    {
        if(Gate::denies("check-if-user-is-admin"))
        {
            return redirect()->back();
        }

        if($user->role->name === 'admin')
        {
            $user->update(['role_id' => 2]);
        }
        else
        {
            $user->update(['role_id' => 1]);
        }

        return redirect()->back();
    }
}
