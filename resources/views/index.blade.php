<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Eラーニングシステムへようこそ
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 text-center">
        <p class="text-lg mb-6">このシステムでは、動画や教材を閲覧し、理解度テストを受けることができます。</p>
        <a href="{{ route('login') }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded">
            ログインはこちら
        </a>
    </div>
</x-app-layout>
