<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dashboard - SportApp</title>

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
            .tab-content {
                display: none;
            }
            .tab-content.active {
                display: block;
            }
            .tab-button {
                transition: all 0.3s ease;
            }
            .tab-button.active {
                color: #667eea;
                background-color: #f3f4f6;
            }
        </style>
    </head>
    <body class="bg-gray-50 min-h-screen pb-20">
        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Tab Content: Accueil -->
            <div id="accueil" class="tab-content active">
                <!-- Welcome Section -->
                <div class="gradient-bg text-white rounded-xl p-8 mb-8">
                    <h2 class="text-3xl font-bold mb-4">Bonjour, {{ $user->first_name }} !</h2>
                    <p class="text-xl opacity-90">Prêt(e) à atteindre vos objectifs ?</p>
                </div>

                <!-- User Goals Section -->
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Mes objectifs</h3>
                    @if($userGoals->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($userGoals as $goal)
                                <div class="card-hover bg-white p-6 rounded-xl shadow-lg border">
                                    <div class="text-4xl mb-4">{{ $goal->icon }}</div>
                                    <h4 class="text-xl font-semibold mb-2">{{ $goal->name }}</h4>
                                    <p class="text-gray-600 mb-4">{{ $goal->description }}</p>
                                    <a href="{{ route('goal.details', $goal->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition duration-200">
                                        Voir les détails
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white p-8 rounded-xl shadow-lg border text-center">
                            <div class="text-6xl mb-4">🎯</div>
                            <h4 class="text-xl font-semibold mb-2">Aucun objectif sélectionné</h4>
                            <p class="text-gray-600 mb-6">Choisissez vos objectifs pour commencer votre transformation !</p>
                            <button onclick="showTab('objectifs')" class="bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition duration-200">
                                Choisir mes objectifs
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-lg border text-center">
                        <div class="text-3xl font-bold text-blue-600">{{ $userGoals->count() }}</div>
                        <div class="text-gray-600">Objectifs actifs</div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg border text-center">
                        <div class="text-3xl font-bold text-green-600">{{ $nutritionItems->count() }}</div>
                        <div class="text-gray-600">Recommandations</div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white p-6 rounded-xl shadow-lg border">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Activité récente</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-gray-700">Objectif "{{ $userGoals->first()->name ?? 'Maigrir' }}" ajouté</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-700">Nouvelle recommandation disponible</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Objectifs -->
            <div id="objectifs" class="tab-content">
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Mes objectifs</h2>
                    <p class="text-gray-600">Gérez vos objectifs fitness</p>
                </div>

                @if($userGoals->count() > 0)
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Objectifs actifs</h3>
                        <div class="space-y-4">
                            @foreach($userGoals as $goal)
                                <div class="bg-white p-6 rounded-xl shadow-lg border">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="text-3xl">{{ $goal->icon }}</div>
                                            <div>
                                                <h4 class="text-lg font-semibold">{{ $goal->name }}</h4>
                                                <p class="text-gray-600 text-sm">{{ $goal->description }}</p>
                                            </div>
                                        </div>
                                        <button onclick="removeGoal({{ $goal->id }})" class="text-red-600 hover:text-red-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Ajouter un objectif</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($allGoals as $goal)
                            @if(!$userGoals->contains('id', $goal->id))
                                <div class="card-hover bg-white p-6 rounded-xl shadow-lg border">
                                    <div class="text-4xl mb-4">{{ $goal->icon }}</div>
                                    <h4 class="text-xl font-semibold mb-2">{{ $goal->name }}</h4>
                                    <p class="text-gray-600 mb-4">{{ $goal->description }}</p>
                                    <button onclick="selectGoal({{ $goal->id }})" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 transition duration-200">
                                        Ajouter cet objectif
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Tab Content: Fitness -->
            <div id="fitness" class="tab-content">
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Fitness</h2>
                    <p class="text-gray-600">Exercices et entraînements</p>
                </div>

                <!-- Exercise Categories -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="card-hover bg-white p-6 rounded-xl shadow-lg border text-center">
                        <div class="text-4xl mb-4">💪</div>
                        <h3 class="text-lg font-semibold mb-2">Musculation</h3>
                        <p class="text-gray-600 text-sm">Développez vos muscles</p>
                    </div>
                    <div class="card-hover bg-white p-6 rounded-xl shadow-lg border text-center">
                        <div class="text-4xl mb-4">🏃‍♀️</div>
                        <h3 class="text-lg font-semibold mb-2">Cardio</h3>
                        <p class="text-gray-600 text-sm">Brûlez des calories</p>
                    </div>
                    <div class="card-hover bg-white p-6 rounded-xl shadow-lg border text-center">
                        <div class="text-4xl mb-4">🧘‍♀️</div>
                        <h3 class="text-lg font-semibold mb-2">Yoga</h3>
                        <p class="text-gray-600 text-sm">Flexibilité et relaxation</p>
                    </div>
                    <div class="card-hover bg-white p-6 rounded-xl shadow-lg border text-center">
                        <div class="text-4xl mb-4">🤸‍♀️</div>
                        <h3 class="text-lg font-semibold mb-2">Pilates</h3>
                        <p class="text-gray-600 text-sm">Renforcement musculaire</p>
                    </div>
                </div>

                <!-- Workout Plan -->
                <div class="bg-white p-6 rounded-xl shadow-lg border">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Plan d'entraînement</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                            <div>
                                <h4 class="font-semibold">Lundi - Cardio</h4>
                                <p class="text-sm text-gray-600">30 min de course</p>
                            </div>
                            <div class="text-green-600">✓</div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <h4 class="font-semibold">Mercredi - Musculation</h4>
                                <p class="text-sm text-gray-600">Squats, fentes, pompes</p>
                            </div>
                            <div class="text-gray-400">⏰</div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <h4 class="font-semibold">Vendredi - Yoga</h4>
                                <p class="text-sm text-gray-600">Séance de relaxation</p>
                            </div>
                            <div class="text-gray-400">⏰</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Profil -->
            <div id="profil" class="tab-content">
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Mon profil</h2>
                    <p class="text-gray-600">Gérez vos informations</p>
                </div>

                <!-- User Info -->
                <div class="bg-white p-6 rounded-xl shadow-lg border mb-6">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">{{ $user->full_name }}</h3>
                            <p class="text-gray-600">{{ $user->full_phone_number }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b">
                            <span class="text-gray-700">Prénom</span>
                            <span class="font-semibold">{{ $user->first_name }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b">
                            <span class="text-gray-700">Nom</span>
                            <span class="font-semibold">{{ $user->last_name }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b">
                            <span class="text-gray-700">Téléphone</span>
                            <span class="font-semibold">{{ $user->full_phone_number }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="text-gray-700">Membre depuis</span>
                            <span class="font-semibold">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Settings -->
                <div class="bg-white p-6 rounded-xl shadow-lg border mb-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Paramètres</h3>
                    <div class="space-y-4">
                        <button class="w-full text-left flex items-center justify-between py-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </div>
                                <span>Modifier le profil</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <button class="w-full text-left flex items-center justify-between py-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span>Notifications</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <button class="w-full text-left flex items-center justify-between py-3 hover:bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span>Aide</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Logout -->
                <form method="POST" action="/auth/logout" class="bg-white p-6 rounded-xl shadow-lg border">
                    <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-medium hover:bg-red-700 transition duration-200">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Navigation Tabs -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-4 py-2">
            <div class="flex justify-around">
                <button onclick="showTab('accueil')" class="tab-button active flex flex-col items-center py-2 px-3 rounded-lg">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-xs">Accueil</span>
                </button>
                <button onclick="showTab('objectifs')" class="tab-button flex flex-col items-center py-2 px-3 rounded-lg">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span class="text-xs">Objectifs</span>
                </button>
                <button onclick="showTab('fitness')" class="tab-button flex flex-col items-center py-2 px-3 rounded-lg">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span class="text-xs">Fitness</span>
                </button>
                <button onclick="showTab('profil')" class="tab-button flex flex-col items-center py-2 px-3 rounded-lg">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-xs">Profil</span>
                </button>
            </div>
        </div>

        <script>
            // Tab functionality
            function showTab(tabName) {
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });

                // Remove active class from all tab buttons
                document.querySelectorAll('.tab-button').forEach(button => {
                    button.classList.remove('active');
                });

                // Show selected tab content
                document.getElementById(tabName).classList.add('active');

                // Add active class to clicked tab button
                event.target.closest('.tab-button').classList.add('active');
            }

            // Goal selection
            async function selectGoal(goalId) {
                try {
                    const response = await fetch('/user/goals', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ goal_id: goalId })
                    });

                    if (response.ok) {
                        location.reload(); // Refresh to show new goal
                    } else {
                        alert('Une erreur est survenue.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Une erreur est survenue.');
                }
            }

            // Remove goal
            async function removeGoal(goalId) {
                if (confirm('Êtes-vous sûr de vouloir supprimer cet objectif ?')) {
                    try {
                        const response = await fetch(`/user/goals/${goalId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        if (response.ok) {
                            location.reload(); // Refresh to update goals
                        } else {
                            alert('Une erreur est survenue.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Une erreur est survenue.');
                    }
                }
            }
        </script>
    </body>
</html>
