<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $year = $request->query('year', now()->year);
        // $testSets = \App\Models\TestSet::pluck('year', 'id');
        $testSets = \App\Models\TestSet::all();
        return view('admin.courses.create', compact('testSets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'required|string|max:20',
            'test_set_id' => 'nullable|exists:test_sets,id',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240', // 10MB limit
        ]);

        $data = $request->only([
            'title', 'description', 'year', 'test_set_id'
        ]);



        if ($request->hasFile('pdf_file')) {
            $filename = time() . '_' . $request->file('pdf_file')->getClientOriginalName();

            $path = $request->file('pdf_file')->storeAs('pdf', $filename);
            $data['pdf_filename'] = $filename;
        }

        \App\Models\Course::create($data);

        return redirect()->route('admin.courses.index')
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

    // 認証されたユーザーでなければ、このPDFにアクセスできないための処理
    public function downloadPdf(Course $course)
    {
        if (!auth()->check()) {
            abort(403); // 未ログインなら403エラーを返す
        }

        return response()->file(storage_path('app/private/pdf/' . $course->pdf_filename));
    }
}
