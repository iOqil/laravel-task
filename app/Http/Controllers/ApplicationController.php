<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index() {}

    public function store(Request $request)
    {

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

        return redirect()->back();
    }


    public function show(string $id) {}


    public function update(Request $request, string $id) {}


    public function destroy(string $id) {}
}
