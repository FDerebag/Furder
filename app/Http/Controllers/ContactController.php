<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Project;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $projects = Project::featured()->ordered()->get();
        return view('welcome', compact('projects'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'projectType' => 'required|string',
            'budget' => 'nullable|string',
            'projectDetails' => 'required|string',
            'timeline' => 'nullable|string',
        ]);

        // Map form fields to database fields
        $messageData = [
            'full_name' => $validatedData['fullName'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'company' => $validatedData['company'],
            'project_type' => $validatedData['projectType'],
            'budget' => $validatedData['budget'],
            'project_details' => $validatedData['projectDetails'],
            'timeline' => $validatedData['timeline'],
        ];

        ContactMessage::create($messageData);

        return response()->json([
            'success' => true,
            'message' => 'Teklif talebiniz başarıyla gönderildi! En kısa sürede size dönüş yapacağız.'
        ]);
    }
}
