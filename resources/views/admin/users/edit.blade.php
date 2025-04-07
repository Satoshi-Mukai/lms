<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">ユーザー編集</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-8">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">名前</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block">部署</label>
                <select name="department_id" class="w-full border p-2 rounded">
                    <option value="">選択してください</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ $user->department_id == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">更新する</button>
        </form>
    </div>
</x-app-layout>