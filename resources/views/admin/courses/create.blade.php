<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="max-w-7xl mx-auto py-6">
        <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label class="block font-bold mb-1">年度</label>
                <input type="text" name="year" class="w-full border rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1">タイトル</label>
                <input type="text" name="title" class="w-full border rounded px-4 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1">説明</label>
                <textarea name="description" class="w-full border rounded px-4 py-2"></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-1">紐づけるテスト</label>
                <select name="test_set_id" class="w-full border rounded px-4 py-2" required>
                    <option value="">選択してください</option>
                    @foreach ($testSets as $testSet)
                        <option value="{{ $testSet->id }}">{{ $testSet->year }}年度</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block font-bold mb-1">教材PDFファイル（任意）</label>
                <input type="file" name="pdf_file" accept="application/pdf" class="w-full border rounded px-4 py-2">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded">
                    登録する
                </button>
            </div>
        </form>
    </div>
</x-app-layout>