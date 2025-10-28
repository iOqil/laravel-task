<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;

class ApplicationController extends Controller
{
    public function index() {}

    public function store(Request $request)
    {

        if($this->checkdate()){
            return redirect()->back()->with(['error' => 'You can only submit one application per day.']);
        }

        if ($request->hasFile('file')) {
            $name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('files', $name, 'public', 'public');
        }

        $validated = $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $app = Application::create([
            'user_id' => Auth::user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null,
        ]);

        dispatch(new SendEmailJob($app));

        return redirect()->back();
    }

    public function checkdate()
    {
        $last_application = Application::where('user_id', Auth::id())->latest()->first();
        $last_app_date = Carbon::parse($last_application->created_at)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        if ($last_app_date === $today) {
            return true;
        }
    }


    public function show(string $id) {}


    public function update(Request $request, string $id) {}


    public function destroy(string $id) {}
}
