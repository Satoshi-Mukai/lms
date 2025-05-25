<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">教材一覧</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white p-4 rounded shadow">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($courses as $course)
                    <div class="border rounded-lg p-4 shadow hover:shadow-lg transition duration-200 bg-white">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            {{ $course->title }}（{{ $course->year }}年度）
                        </h3>
                        <a href="{{ route('user.courses.show', $course->id) }}"
                           class="inline-block mt-2 text-sm text-blue-600 hover:underline font-medium">
                            → 教材を開く
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>