<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    public function main()
    {
        return redirect('/dashboard');
    }

    public function dashboard()
    {
        return view('dashboard')->with([
            'applications' => Application::paginate(10),
            'clieant_applications' => Application::where('user_id', Auth::user()->id)->paginate(10),
        ]);
    }
}
