<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">テスト結果</h2>
    </x-slot>

    <div class="p-6 space-y-4 text-center">
        <p>正解数：<strong>{{ $correctCount }} / {{ $total }}</strong></p>
        <p>スコア：<strong>{{ $scorePercent }}%</strong></p>

        @if ($isPass)
            <p class="text-green-600 font-bold text-xl">🎉 合格です！おめでとうございます！</p>
        @else
            <p class="text-red-600 font-bold text-xl">❌ 不合格です。再挑戦しましょう！</p>
        @endif

        <a href="{{ route('user.dashboard') }}"
           class="mt-6 inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-6 py-2 rounded">
            ダッシュボードに戻る
        </a>
    </div>
</x-app-layout>