<!-- resources/views/user/courses/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">{{ $course->title }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="aspect-w-16 aspect-h-9 mb-4">
            <iframe src="{{ $course->youtube_url }}" frameborder="0" allowfullscreen class="w-full h-96"></iframe>
        </div>

        <p class="mb-6 text-gray-700">{{ $course->description }}</p>

        <a href="{{ route('user.tests.show', $course->testSet->id) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded">
            理解度テストに進む
        </a>
    </div>
</x-app-layout>