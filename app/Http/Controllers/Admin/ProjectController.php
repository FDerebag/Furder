<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Constructor removed - middleware handled in routes

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::ordered()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'detailed_description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'technologies' => 'required|array',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration_days' => 'nullable|integer|min:1',
            'completed_at' => 'nullable|date',
            'status' => 'required|in:completed,ongoing,paused',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Handle main image upload
        if ($request->hasFile('image')) {
            $validatedData['image_path'] = $request->file('image')->store('projects', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('projects/gallery', 'public');
            }
            $validatedData['gallery'] = $galleryPaths;
        }

        unset($validatedData['image']);
        
        Project::create($validatedData);

        return redirect()->route('admin.projects.index')->with('success', 'Proje başarıyla oluşturuldu!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'detailed_description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'technologies' => 'required|array',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration_days' => 'nullable|integer|min:1',
            'completed_at' => 'nullable|date',
            'status' => 'required|in:completed,ongoing,paused',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image_path) {
                Storage::disk('public')->delete($project->image_path);
            }
            $validatedData['image_path'] = $request->file('image')->store('projects', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery')) {
            // Delete old gallery images
            if ($project->gallery) {
                $galleryArray = is_array($project->gallery) ? $project->gallery : (json_decode($project->gallery, true) ?? []);
                foreach ($galleryArray as $imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('projects/gallery', 'public');
            }
            $validatedData['gallery'] = $galleryPaths;
        }

        unset($validatedData['image']);
        
        $project->update($validatedData);

        return redirect()->route('admin.projects.index')->with('success', 'Proje başarıyla güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete associated images
        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }
        
        if ($project->gallery) {
            $galleryArray = is_array($project->gallery) ? $project->gallery : (json_decode($project->gallery, true) ?? []);
            foreach ($galleryArray as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Proje başarıyla silindi!');
    }
}
