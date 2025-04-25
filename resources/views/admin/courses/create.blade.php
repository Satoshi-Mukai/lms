<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ $year }}年度 教材登録
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.courses.store') }}">
            @csrf

            <input type="hidden" name="year" value="{{ $year }}">

            <div class="mb-4">
                <label class="block font-bold mb-1">教材タイトル</label>
                <input type="text" name="title" class="w-full border rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1">教材説明</label>
                <textarea name="description" class="w-full border rounded px-4 py-2" rows="3"></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1">YouTube URL</label>
                <input type="url" name="youtube_url" class="w-full border rounded px-4 py-2">
            </div>

            <div class="mb-6">
                <label class="block font-bold mb-1">紐づけるテスト（任意）</label>
                <select name="test_set_id" class="w-full border rounded px-4 py-2">
                    <option value="">-- 紐づけなし --</option>
                    @foreach ($testSets as $id => $setYear)
                        <option value="{{ $id }}">{{ $setYear }}年度テスト</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.courses.index', ['year' => $year]) }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded shadow">
                    キャンセル
                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded shadow">
                    登録する
                </button>
            </div>
        </form>
    </div>
</x-app-layout>