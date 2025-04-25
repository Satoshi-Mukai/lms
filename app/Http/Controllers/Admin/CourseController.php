<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = $request->query('year', now()->year); // デフォルトは今年
        $courses = Course::where('year', $year)->get();
    
        return view('admin.courses.index', compact('courses', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $year = $request->query('year', now()->year);
        $testSets = \App\Models\TestSet::pluck('year', 'id');
        return view('admin.courses.create', compact('year', 'testSets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'required|string|max:4',
            'youtube_url' => 'nullable|url',
            'test_set_id' => 'nullable|exists:test_sets,id',
        ]);
    
        \App\Models\Course::create($request->only([
            'title', 'description', 'year', 'youtube_url', 'test_set_id'
        ]));
    
        return redirect()->route('admin.courses.index', ['year' => $request->year])
                         ->with('success', '教材を登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
