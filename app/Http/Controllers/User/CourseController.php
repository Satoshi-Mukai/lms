<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::latest()->get();
        return view('user.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Course $course)
    {
        //$course1=\App\Models\Course::find(4);
        //dd($course);
        //    
        $course->load('testSet');
        //dd($course);

        return view('user.courses.show', compact('course'));
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
    public function downloadPdf(Course $course)
    {
        $path = storage_path('app/private/pdf/' . $course->pdf_filename);

        if (!$course->pdf_filename || !file_exists($path)) {
            abort(404, 'PDFファイルが存在しません');
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $course->pdf_filename . '"',
        ]);
    }
}
