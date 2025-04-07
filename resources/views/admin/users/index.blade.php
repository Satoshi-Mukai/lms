<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ '受講者一覧' }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">名前</th>
                        <th class="px-4 py-2">メールアドレス</th>
                        <th class="px-4 py-2">部署名</th>
                        <th class="px-4 py-2">登録日</th>
                        <th class="px-4 py-2">更新</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $user->id }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ optional($user->department)->name ?? '未所属' }}</td>
                        <td class="px-4 py-2">{{ $user->created_at->format('Y/m/d') }}</td>
                        <td class="px-4 py-2">{{-- 編集ボタン --}}
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="text-blue-500 hover:underline text-sm">編集</a>
                                {{-- 削除フォーム --}}
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                      onsubmit="return confirm('本当に削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline text-sm">削除</button>
                                </form></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
