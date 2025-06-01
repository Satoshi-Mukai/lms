<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            教材一覧
        </h2>
    </x-slot>

    <div class="flex justify-end mb-4 px-6">
        <a href="{{ route('admin.courses.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow">
            ＋ 新規教材を作成
        </a>
    </div>

    <div class="p-6">
        @foreach ($courses as $course)
            <div class="mb-4 p-4 bg-white shadow rounded">
                <h3 class="text-lg font-bold">{{ $course->title }}</h3>
                <p class="text-gray-700">{{ $course->description }}</p>
                <p class="text-sm text-gray-500">登録日: {{ $course->created_at->format('Y/m/d') }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>