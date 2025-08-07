<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $goal->name }} - SportApp</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif

        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            .card-hover {
                transition: all 0.3s ease;
            }
            .card-hover:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body class="bg-gray-50 min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-gray-900">🏃‍♀️ SportApp</a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900">← Retour au dashboard</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Goal Header -->
            <div class="gradient-bg text-white rounded-xl p-8 mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="text-6xl">{{ $goal->icon }}</div>
                    <div>
                        <h1 class="text-4xl font-bold">{{ $goal->name }}</h1>
                        <p class="text-xl opacity-90">{{ $goal->description }}</p>
                    </div>
                </div>

                @if(!$userHasGoal)
                    <button onclick="addGoal()" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-200">
                        Ajouter cet objectif
                    </button>
                @else
                    <div class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold text-lg inline-block">
                        ✓ Objectif actif
                    </div>
                @endif
            </div>

            <!-- Nutrition Section -->
            @if($nutritionItems->count() > 0)
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Recommandations nutritionnelles</h2>

                    <!-- Tisanes -->
                    @php $tisanes = $nutritionItems->where('type', 'tisane'); @endphp
                    @if($tisanes->count() > 0)
                        <div class="mb-8">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-4">🍵 Tisanes</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($tisanes as $item)
                                    <div class="card-hover bg-white p-6 rounded-xl shadow-lg border">
                                        <h4 class="text-xl font-semibold mb-2">{{ $item->name }}</h4>
                                        <p class="text-gray-600 mb-4">{{ $item->description }}</p>

                                        @if($item->ingredients)
                                            <div class="mb-4">
                                                <h5 class="font-semibold text-gray-900 mb-2">Ingrédients :</h5>
                                                <p class="text-sm text-gray-600">{{ $item->ingredients }}</p>
                                            </div>
                                        @endif

                                        @if($item->instructions)
                                            <div class="mb-4">
                                                <h5 class="font-semibold text-gray-900 mb-2">Préparation :</h5>
                                                <p class="text-sm text-gray-600">{{ $item->instructions }}</p>
                                            </div>
                                        @endif

                                        <div class="flex items-center justify-between text-sm text-gray-500">
                                            <span>{{ $item->preparation_time_minutes }} min</span>
                                            @if($item->calories)
                                                <span>{{ $item->calories }} cal</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Plats -->
                    @php $plats = $nutritionItems->where('type', 'plat'); @endphp
                    @if($plats->count() > 0)
                        <div class="mb-8">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-4">🍽️ Plats</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($plats as $item)
                                    <div class="card-hover bg-white p-6 rounded-xl shadow-lg border">
                                        <h4 class="text-xl font-semibold mb-2">{{ $item->name }}</h4>
                                        <p class="text-gray-600 mb-4">{{ $item->description }}</p>

                                        @if($item->ingredients)
                                            <div class="mb-4">
                                                <h5 class="font-semibold text-gray-900 mb-2">Ingrédients :</h5>
                                                <p class="text-sm text-gray-600">{{ $item->ingredients }}</p>
                                            </div>
                                        @endif

                                        @if($item->instructions)
                                            <div class="mb-4">
                                                <h5 class="font-semibold text-gray-900 mb-2">Instructions :</h5>
                                                <p class="text-sm text-gray-600">{{ $item->instructions }}</p>
                                            </div>
                                        @endif

                                        <div class="flex items-center justify-between text-sm text-gray-500">
                                            <span>{{ $item->preparation_time_minutes }} min</span>
                                            @if($item->calories)
                                                <span>{{ $item->calories }} cal</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-white p-8 rounded-xl shadow-lg border text-center">
                    <div class="text-6xl mb-4">🥗</div>
                    <h3 class="text-xl font-semibold mb-2">Aucune recommandation nutritionnelle</h3>
                    <p class="text-gray-600">Les recommandations pour cet objectif seront bientôt disponibles.</p>
                </div>
            @endif

            <!-- Tips Section -->
            <div class="bg-blue-50 p-8 rounded-xl">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">💡 Conseils pour {{ $goal->name }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Conseils généraux :</h3>
                        <ul class="text-gray-700 space-y-2">
                            <li>• Restez hydraté(e) tout au long de la journée</li>
                            <li>• Mangez équilibré et régulièrement</li>
                            <li>• Dormez suffisamment (7-8h par nuit)</li>
                            <li>• Soyez patient(e), les résultats prennent du temps</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Motivation :</h3>
                        <ul class="text-gray-700 space-y-2">
                            <li>• Fixez-vous des objectifs réalistes</li>
                            <li>• Célébrez vos petites victoires</li>
                            <li>• Trouvez un partenaire d'entraînement</li>
                            <li>• Gardez un journal de vos progrès</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <script>
            async function addGoal() {
                try {
                    const response = await fetch('/user/goals', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ goal_id: {{ $goal->id }} })
                    });

                    if (response.ok) {
                        location.reload(); // Refresh to show goal as active
                    } else {
                        alert('Une erreur est survenue.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Une erreur est survenue.');
                }
            }
        </script>
    </body>
</html>
