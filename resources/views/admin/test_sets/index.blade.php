<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ '理解度テスト一覧' }}
        </h2>
    </x-slot>

    @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        <div class="flex justify-end mb-4 px-6">
    <a href="{{ route('admin.test_sets.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow">
        ＋ 新規テストを作成
    </a>
</div>
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2">年度</th>
                        <th class="px-4 py-2">テスト名</th>
                        <th class="px-4 py-2">登録日</th>
                        <th class="px-4 py-2">詳細/編集</th>
                      </tr>
                </thead>
                <tbody>
                    @foreach ($testSets as $testSet)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $testSet->year }}</td>
                        <td class="px-4 py-2">{{ $testSet->name }}</td>
                        <td class="px-4 py-2">{{ $testSet->created_at->format('Y/m/d') }}</td>
                        <td class="px-4 py-2">{{-- 編集ボタン --}}
                                <a href="{{ route('admin.test_sets.edit', $testSet->id) }}"
                                   class="text-blue-500 hover:underline text-sm">編集</a>
                                </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
