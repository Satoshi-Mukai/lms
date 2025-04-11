<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">テストセット編集</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-6">
        <div class="bg-white p-6 rounded shadow">
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.test_sets.update', $testSet->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-bold mb-1">年度</label>
                    <input type="text" name="year" value="{{ old('year', $testSet->year) }}"
                           class="w-full border-gray-300 rounded shadow-sm px-4 py-2" required>
                </div>

                <div class="mb-6">
                    <label class="block font-bold mb-1">テスト名</label>
                    <input type="text" name="name" value="{{ old('name', $testSet->name) }}"
                           class="w-full border-gray-300 rounded shadow-sm px-4 py-2">
                </div>

                @foreach ($testSet->questions as $index => $question)
                    <div class="mb-6 p-4 border rounded shadow-sm bg-gray-50">
                        <h3 class="font-semibold mb-2">問題 {{ $index + 1 }}</h3>

                        <div class="mb-3">
                            <label class="block font-bold">問題文</label>
                            <input type="text" name="questions[{{ $index }}][title]" value="{{ old("questions.$index.title", $question->title) }}"
                                   class="w-full border rounded px-3 py-2" required>
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-between">
                    <a href="{{ route('admin.test_sets.index') }}"
                       class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded shadow">
                        キャンセル
                    </a>

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                        更新する
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>