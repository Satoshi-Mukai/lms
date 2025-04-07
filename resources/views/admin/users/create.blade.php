<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">新規ユーザー登録</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
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

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">名前</label>
                    <input type="text" name="name" class="w-full border-gray-300 rounded shadow-sm" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">メールアドレス</label>
                    <input type="email" name="email" class="w-full border-gray-300 rounded shadow-sm" value="{{ old('email') }}" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">パスワード</label>
                    <input type="password" name="password" class="w-full border-gray-300 rounded shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">パスワード（確認）</label>
                    <input type="password" name="password_confirmation" class="w-full border-gray-300 rounded shadow-sm" required>
                </div>

                <div class="mb-6">
                    <label class="block font-medium text-sm text-gray-700">部署</label>
                    <select name="department_id" class="w-full border-gray-300 rounded shadow-sm">
                        <option value="">-- 選択してください --</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('admin.users') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded shadow mr-4">キャンセル</a>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                        登録する
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>