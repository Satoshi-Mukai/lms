<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">テストセット作成</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.test_sets.store') }}" method="POST">
            @csrf

            <!-- 年度とテスト名 -->
            <div class="mb-4">
                <label class="block font-bold mb-1">年度</label>
                <input type="text" name="year" class="w-full border rounded px-4 py-2" required placeholder="例: 2025">
            </div>

            <div class="mb-6">
                <label class="block font-bold mb-1">テスト名（任意）</label>
                <input type="text" name="name" class="w-full border rounded px-4 py-2">
            </div>

            @for ($i = 0; $i < 3; $i++)
                <div class="mb-6 p-4 border rounded shadow-sm bg-gray-50">
                    <h3 class="font-semibold mb-2">問題 {{ $i + 1 }}</h3>

                    <div class="mb-3">
                        <label class="block font-bold">問題文</label>
                        <input type="text" name="questions[{{ $i }}][title]" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-3">
                        <label class="block font-bold mb-1">選択肢</label>

                        @for ($j = 0; $j < 3; $j++)
                            <div class="flex items-center mb-2">
                                <input type="radio" name="questions[{{ $i }}][correct_choice]" value="{{ $j }}" class="mr-2" required>
                                <input type="text" name="questions[{{ $i }}][choices][{{ $j }}]" class="w-full border rounded px-3 py-1" required placeholder="選択肢 {{ chr(65 + $j) }}">
                            </div>
                        @endfor

                        <p class="text-sm text-gray-500">正解のラジオボタンを1つ選んでください。</p>
                    </div>
                </div>
            @endfor

            <div class="flex justify-between mt-6">
            <a href="{{ route('admin.dashboard') }}"
              class="bg-gray-300 hover:bg-gray-500 text-gray-800 font-semibold px-6 py-2 rounded shadow transition duration-200">
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