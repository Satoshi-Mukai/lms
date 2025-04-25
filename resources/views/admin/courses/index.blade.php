<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ $year }}年度の教材一覧
        </h2>
    </x-slot>

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