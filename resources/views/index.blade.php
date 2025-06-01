<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ようこそ - Eラーニングシステム</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <header class="bg-white shadow p-4">
        <h2 class="text-xl font-semibold text-gray-800">
            Eラーニングシステムへようこそ
        </h2>
    </header>

    <div class="h-40"></div>
    <main class="max-w-4xl mx-auto text-center">
        <p class="text-lg mb-6">このシステムでは、動画や教材を閲覧し、理解度テストを受けることができます。</p>
        <a href="{{ route('login') }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded">
            ログインはこちら
        </a>
    </main>
</body>
</html>
