<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Constructor removed - middleware handled in routes

    public function dashboard()
    {
        $stats = [
            'total_projects' => Project::count(),
            'featured_projects' => Project::featured()->count(),
            'total_messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::unread()->count(),
        ];

        $recent_messages = ContactMessage::recent()->limit(5)->get();
        $recent_projects = Project::ordered()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_messages', 'recent_projects'));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials, $request->boolean('remember'))) {
            if (auth()->user()->isAdmin()) {
                return redirect()->intended('/admin');
            } else {
                auth()->logout();
                return back()->withErrors([
                    'email' => 'Bu hesapla admin paneline erişim yetkiniz yok.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Giriş bilgileri hatalı.',
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
