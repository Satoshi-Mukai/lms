<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">部署一覧</h2>
    </x-slot>
    <a href="{{ route('admin.departments.create') }}" class="bg-green-500 text-black px-4 py-2 rounded">＋ 新規部署を作成</a>
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">部署名</th>
                        <th class="px-4 py-2">作成日</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $department->id }}</td>
                            <td class="px-4 py-2">{{ $department->name }}</td>
                            <td class="px-4 py-2">{{ $department->created_at->format('Y/m/d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
