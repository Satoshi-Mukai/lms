<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">{{ $testSet->year }}年 理解度テスト</h2>
    </x-slot>

    <form action="{{ route('user.tests.submit', $testSet->id) }}" method="POST" class="space-y-6">
        @csrf

        @foreach($testSet->questions as $index => $question)
            <div class="p-4 bg-white rounded shadow">
                <p class="font-semibold">Q{{ $index + 1 }}. {{ $question->title }}</p>
                @foreach($question->choices as $choice)
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $choice->id }}" class="form-radio">
                            <span class="ml-2">{{ $choice->text }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2 rounded">
                回答を送信する
            </button>
        </div>
    </form>
</x-app-layout>