<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">{{ $test_set->year }}年 理解度テスト</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <form action="{{ route('user.tests.submit', $test_set->id) }}" method="POST">
            @csrf

            @foreach ($test_set->questions as $index => $question)
                <div class="mb-6">
                    <p class="font-bold">Q{{ $index + 1 }}. {{ $question->title }}</p>
                    @foreach ($question->choices as $choice)
                        <div class="ml-4">
                            <label class="inline-flex items-center">
                                <input type="radio"
                                       name="answers[{{ $question->id }}]"
                                       value="{{ $choice->id }}"
                                       class="mr-2" required>
                                {{ $choice->text }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="mt-8">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded">
                    回答を送信する
                </button>
            </div>
        </form>
    </div>
</x-app-layout>