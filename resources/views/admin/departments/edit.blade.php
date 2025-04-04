<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">部署の編集</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded">
            <form method="POST" action="{{ route('admin.departments.update', $department->id) }}">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-medium text-sm text-gray-700">部署名</label>
                    <input type="text" name="name" value="{{ old('name', $department->name) }}" class="border rounded w-full p-2 mt-1" required>
                    @error('name')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mt-4 flex gap-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">更新</button>
                    <a href="{{ route('admin.departments') }}" class="text-gray-600 hover:underline">戻る</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
