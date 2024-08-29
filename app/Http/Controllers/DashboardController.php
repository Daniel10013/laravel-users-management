<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function render(): View{
        $userName = (Auth::user())->name; 
        return view("dashboard", [
            'users' => User::all(),
            'userName' => $userName
        ]);
    }
}
