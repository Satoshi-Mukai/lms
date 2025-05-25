<!-- resources/views/user/courses/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">{{ $course->title }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        @if ($course->pdf_filename)
            <div class="aspect-w-16 aspect-h-9">
                <!-- <iframe src="{{ asset('pdfjs/web/viewer.html') }}?file={{ asset('storage/pdf/' . $course->pdf_filename) }}" class="w-full h-[600px]" frameborder="0"></iframe> -->
                
                <!-- これで動作はできたが、PDFが公開状態になってしまう
                iframe src="{{ asset('storage/pdf/' . $course->pdf_filename) }}" width="100%" height="600px"></!--iframe-->

                <iframe src="{{ route('user.courses.pdf', $course->id) }}" width="100%" height="600px"></iframe>
            </div>
        @else
            <p class="text-gray-500">PDF教材が登録されていません。</p>
        @endif

        <p class="mb-6 text-gray-700">{{ $course->description }}</p>

        <a href="{{ route('user.tests.show', $course->testSet->id) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded">
            理解度テストに進む
        </a>
    </div>
</x-app-layout>