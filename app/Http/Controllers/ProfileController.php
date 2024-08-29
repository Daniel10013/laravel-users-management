<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

use function Termwind\render;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function render(Request $request): View
    {   
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /*
     * Display an user profile based on it's id
    */
    public function getUserDetails(Request $request): View{
        $userId = $request->id;
        User::find($userId);
        return view("profile.user-details", [
            'user' => User::find($userId),
            'admin' => true
        ]);
    }

    /* 
     * Delete an user by it's id 
    */
    public function deleteUserById(Request $request): RedirectResponse{
        $idToDelete = $request->id;
        $userToDelete = User::find($idToDelete);
        $hasDeleted = $userToDelete->delete();
        if($hasDeleted == false){
            return redirect((route('render-details-page', $idToDelete)))->with('delete-error', 'An error ocurred while trying to delete the account! Please try again.');
        }
        return redirect((route("dashboard")))->with('sucess', 'User account deleted successfuly!');
    }

    /**
     * Unlock an user's locked account
     */

    public function unlockAccount(Request $request): RedirectResponse{
        $idToUnlock = $request->id;
        
        $userToUnlock = User::find($idToUnlock);
        $userToUnlock->account_locked = 0;
        $userToUnlock->failed_login_attempts = 0;

        if($userToUnlock->save()){
            return redirect(route('render-details-page', $idToUnlock))
            ->with('success', 'Unlocked the account successfully!');
        }

        return redirect(route('render-details-page'))
        ->with('error', 'Error while trying to unlock the account! Try again later!');
    }
}
