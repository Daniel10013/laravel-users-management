<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Auth\RegisteredUserController;

class CreateUserController extends Controller
{
    public function render(): View{
        return view('create-user');
    }

    /**
     * Create an new user
     */
    public function createUser(Request $request): RedirectResponse{
        $user = (new RegisteredUserController())->createUser($request);
        if(isset($user->id)){
            return redirect('create-user')->with('success', 'Account created succesfully!');
        }

        return redirect('create-user')->with('error', 'Error while trying to create account! Please try again.');
    }
}