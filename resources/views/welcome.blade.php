<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SportApp - Votre coach personnel</title>

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
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
                            <h1 class="text-2xl font-bold text-gray-900">🏃‍♀️ SportApp</h1>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button id="loginBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                            Se connecter
                        </button>
                        <button id="registerBtn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                            S'inscrire
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="gradient-bg text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        Transformez votre corps
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 opacity-90">
                        Votre coach personnel pour atteindre vos objectifs fitness
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button id="startBtn" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-200">
                            Commencer maintenant
                        </button>
                        <button id="learnMoreBtn" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-600 transition duration-200">
                            En savoir plus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Pourquoi choisir SportApp ?
                    </h2>
                    <p class="text-xl text-gray-600">
                        Une approche personnalisée pour chaque objectif
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="card-hover bg-white p-8 rounded-xl shadow-lg border">
                        <div class="text-4xl mb-4">🎯</div>
                        <h3 class="text-xl font-semibold mb-4">Objectifs personnalisés</h3>
                        <p class="text-gray-600">
                            Choisissez votre objectif : maigrir, grossir les fesses, tonifier les seins, etc.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="card-hover bg-white p-8 rounded-xl shadow-lg border">
                        <div class="text-4xl mb-4">💪</div>
                        <h3 class="text-xl font-semibold mb-4">Exercices adaptés</h3>
                        <p class="text-gray-600">
                            Des exercices spécialement sélectionnés pour votre objectif
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="card-hover bg-white p-8 rounded-xl shadow-lg border">
                        <div class="text-4xl mb-4">🥗</div>
                        <h3 class="text-xl font-semibold mb-4">Nutrition complémentaire</h3>
                        <p class="text-gray-600">
                            Tisanes et plats pour optimiser vos résultats
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Goals Section -->
        <div class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Vos objectifs
                    </h2>
                    <p class="text-xl text-gray-600">
                        Sélectionnez ce qui vous correspond le mieux
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="goalsGrid">
                    <!-- Goals will be loaded here -->
                </div>
            </div>
        </div>

        <!-- Auth Modals -->
        <!-- Login Modal -->
        <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg p-8 max-w-md w-full">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">Se connecter</h3>
                        <button id="closeLoginModal" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                    </div>

                    <form id="loginForm" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Indicatif pays</label>
                            <select id="loginCountryCode" class="w-full p-3 border border-gray-300 rounded-lg">
                                <option value="221">🇸🇳 Sénégal (+221)</option>
                                <option value="33">🇫🇷 France (+33)</option>
                                <option value="245">🇬🇳 Guinée (+245)</option>
                                <option value="225">🇨🇮 Côte d'Ivoire (+225)</option>
                                <option value="237">🇨🇲 Cameroun (+237)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
                            <input type="tel" id="loginPhone" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Ex: 123456789">
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-200">
                            Continuer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <div id="registerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg p-8 max-w-md w-full">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">S'inscrire</h3>
                        <button id="closeRegisterModal" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                    </div>

                    <form id="registerForm" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                                <input type="text" id="firstName" class="w-full p-3 border border-gray-300 rounded-lg" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                                <input type="text" id="lastName" class="w-full p-3 border border-gray-300 rounded-lg" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Indicatif pays</label>
                            <select id="registerCountryCode" class="w-full p-3 border border-gray-300 rounded-lg">
                                <option value="221">🇸🇳 Sénégal (+221)</option>
                                <option value="33">🇫🇷 France (+33)</option>
                                <option value="245">🇬🇳 Guinée (+245)</option>
                                <option value="225">🇨🇮 Côte d'Ivoire (+225)</option>
                                <option value="237">🇨🇲 Cameroun (+237)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
                            <input type="tel" id="registerPhone" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Ex: 123456789" required>
                        </div>

                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-medium hover:bg-green-700 transition duration-200">
                            Créer mon compte
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- User Verification Modal -->
        <div id="userVerificationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg p-8 max-w-md w-full text-center">
                    <div class="text-6xl mb-4">👤</div>
                    <h3 class="text-2xl font-bold mb-4">Confirmer votre identité</h3>
                    <p class="text-gray-600 mb-6" id="userInfo"></p>

                    <div class="space-y-4">
                        <button id="confirmUser" class="w-full bg-green-600 text-white py-3 rounded-lg font-medium hover:bg-green-700 transition duration-200">
                            Oui, c'est moi
                        </button>
                        <button id="cancelVerification" class="w-full bg-gray-300 text-gray-700 py-3 rounded-lg font-medium hover:bg-gray-400 transition duration-200">
                            Non, ce n'est pas moi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Modal functions
            function showModal(modalId) {
                document.getElementById(modalId).classList.remove('hidden');
            }

            function hideModal(modalId) {
                document.getElementById(modalId).classList.add('hidden');
            }

            // Event listeners
            document.getElementById('loginBtn').addEventListener('click', () => showModal('loginModal'));
            document.getElementById('registerBtn').addEventListener('click', () => showModal('registerModal'));
            document.getElementById('closeLoginModal').addEventListener('click', () => hideModal('loginModal'));
            document.getElementById('closeRegisterModal').addEventListener('click', () => hideModal('registerModal'));
            document.getElementById('startBtn').addEventListener('click', () => showModal('registerModal'));

            // Close modals when clicking outside
            document.querySelectorAll('[id$="Modal"]').forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        hideModal(modal.id);
                    }
                });
            });

            // Load goals
            fetch('/goals')
                .then(response => response.json())
                .then(data => {
                    const goalsGrid = document.getElementById('goalsGrid');
                    data.goals.forEach(goal => {
                        const goalCard = document.createElement('div');
                        goalCard.className = 'card-hover bg-white p-6 rounded-xl shadow-lg border cursor-pointer';
                        goalCard.innerHTML = `
                            <div class="text-4xl mb-4">${goal.icon}</div>
                            <h3 class="text-xl font-semibold mb-2">${goal.name}</h3>
                            <p class="text-gray-600">${goal.description}</p>
                        `;
                        goalsGrid.appendChild(goalCard);
                    });
                })
                .catch(error => console.error('Error loading goals:', error));

            // Form submissions
            document.getElementById('loginForm').addEventListener('submit', async (e) => {
                e.preventDefault();
                const phone = document.getElementById('loginPhone').value;
                const countryCode = document.getElementById('loginCountryCode').value;

                try {
                    const response = await fetch('/auth/verify-identity', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ phone_number: phone, country_code: countryCode })
                    });

                    const data = await response.json();

                    if (data.exists) {
                        document.getElementById('userInfo').textContent = `Est-ce bien ${data.user.full_name} ?`;
                        hideModal('loginModal');
                        showModal('userVerificationModal');
                    } else {
                        alert('Aucun utilisateur trouvé avec ce numéro de téléphone.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Une erreur est survenue.');
                }
            });

            document.getElementById('registerForm').addEventListener('submit', async (e) => {
                e.preventDefault();
                const firstName = document.getElementById('firstName').value;
                const lastName = document.getElementById('lastName').value;
                const phone = document.getElementById('registerPhone').value;
                const countryCode = document.getElementById('registerCountryCode').value;

                try {
                    const response = await fetch('/auth/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            first_name: firstName,
                            last_name: lastName,
                            phone_number: phone,
                            country_code: countryCode
                        })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        alert('Compte créé avec succès !');
                        hideModal('registerModal');
                        // Redirect to dashboard or goals selection
                        window.location.href = '/dashboard';
                    } else {
                        alert(data.message || 'Une erreur est survenue.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Une erreur est survenue.');
                }
            });

            document.getElementById('confirmUser').addEventListener('click', async () => {
                const phone = document.getElementById('loginPhone').value;
                const countryCode = document.getElementById('loginCountryCode').value;

                try {
                    const response = await fetch('/auth/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ phone_number: phone, country_code: countryCode })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        alert('Connexion réussie !');
                        hideModal('userVerificationModal');
                        // Redirect to dashboard
                        window.location.href = '/dashboard';
                    } else {
                        alert(data.message || 'Une erreur est survenue.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Une erreur est survenue.');
                }
            });

            document.getElementById('cancelVerification').addEventListener('click', () => {
                hideModal('userVerificationModal');
            });
        </script>
    </body>
</html>
