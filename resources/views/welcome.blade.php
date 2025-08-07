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

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

            body {
                font-family: 'Inter', sans-serif;
            }

            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            .gradient-bg-2 {
                background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            }

            .gradient-bg-3 {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            }

            .card-hover {
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }

            .card-hover:hover {
                transform: translateY(-10px) scale(1.02);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            }

            .floating {
                animation: floating 3s ease-in-out infinite;
            }

            @keyframes floating {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }

            .pulse-glow {
                animation: pulse-glow 2s ease-in-out infinite alternate;
            }

            @keyframes pulse-glow {
                from { box-shadow: 0 0 20px rgba(102, 126, 234, 0.4); }
                to { box-shadow: 0 0 30px rgba(102, 126, 234, 0.8); }
            }

            .slide-in {
                animation: slideIn 0.8s ease-out;
            }

            @keyframes slideIn {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
            }

            .btn-primary::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: left 0.5s;
            }

            .btn-primary:hover::before {
                left: 100%;
            }

            .btn-secondary {
                background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                transition: all 0.3s ease;
            }

            .btn-secondary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(240, 147, 251, 0.4);
            }

            .glass-effect {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .stats-card {
                background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255,255,255,0.2);
            }
        </style>
    </head>
    <body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen overflow-x-hidden">
        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 glass-effect">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-2xl font-bold text-white flex items-center">
                                <i class="fas fa-dumbbell mr-2 text-yellow-300"></i>
                                SportApp
                            </h1>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button id="loginBtn" class="text-white hover:text-yellow-300 transition duration-200 p-2">
                            <i class="fas fa-user text-2xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="gradient-bg text-white pt-20 pb-32 relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0">
                <div class="absolute top-20 left-10 w-20 h-20 bg-white bg-opacity-10 rounded-full floating"></div>
                <div class="absolute top-40 right-20 w-16 h-16 bg-white bg-opacity-10 rounded-full floating" style="animation-delay: 1s;"></div>
                <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white bg-opacity-10 rounded-full floating" style="animation-delay: 2s;"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div class="text-center slide-in">
                    <div class="mb-8">
                        <i class="fas fa-fire text-6xl text-yellow-300 mb-4"></i>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                        Transformez votre
                        <span class="text-yellow-300">corps</span>
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 opacity-90 max-w-3xl mx-auto">
                        Votre coach personnel intelligent pour atteindre vos objectifs fitness avec des exercices personnalisés et une nutrition optimisée
                    </p>

                    <!-- Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 max-w-4xl mx-auto">
                        <div class="stats-card p-6 rounded-2xl">
                            <div class="text-3xl font-bold mb-2">10K+</div>
                            <div class="text-sm opacity-80">Utilisateurs actifs</div>
                        </div>
                        <div class="stats-card p-6 rounded-2xl">
                            <div class="text-3xl font-bold mb-2">500+</div>
                            <div class="text-sm opacity-80">Exercices disponibles</div>
                        </div>
                        <div class="stats-card p-6 rounded-2xl">
                            <div class="text-3xl font-bold mb-2">95%</div>
                            <div class="text-sm opacity-80">Taux de satisfaction</div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <button id="startBtn" class="btn-primary text-white px-10 py-4 rounded-full font-semibold text-lg pulse-glow flex items-center justify-center">
                            <i class="fas fa-rocket mr-3"></i>
                            Commencer maintenant
                        </button>
                        <button id="learnMoreBtn" class="glass-effect text-white px-10 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transition duration-200 flex items-center justify-center">
                            <i class="fas fa-play mr-3"></i>
                            Voir la démo
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-32 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Pourquoi choisir
                        <span class="text-blue-600">SportApp</span> ?
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Une approche révolutionnaire qui combine technologie et expertise pour des résultats garantis
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="card-hover bg-gradient-to-br from-blue-50 to-indigo-100 p-8 rounded-2xl shadow-xl border border-blue-200">
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-bullseye text-3xl text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-center text-gray-800">Objectifs personnalisés</h3>
                        <p class="text-gray-600 text-center leading-relaxed">
                            Choisissez votre objectif : maigrir, grossir les fesses, tonifier les seins, etc. Notre IA crée un plan sur mesure.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="card-hover bg-gradient-to-br from-green-50 to-emerald-100 p-8 rounded-2xl shadow-xl border border-green-200">
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-dumbbell text-3xl text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-center text-gray-800">Exercices adaptés</h3>
                        <p class="text-gray-600 text-center leading-relaxed">
                            Des exercices spécialement sélectionnés et adaptés à votre niveau et à vos objectifs spécifiques.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="card-hover bg-gradient-to-br from-purple-50 to-pink-100 p-8 rounded-2xl shadow-xl border border-purple-200">
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-leaf text-3xl text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-center text-gray-800">Nutrition complémentaire</h3>
                        <p class="text-gray-600 text-center leading-relaxed">
                            Tisanes et plats nutritionnels pour optimiser vos résultats et accélérer votre transformation.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Goals Section -->
        <div class="py-32 bg-gradient-to-br from-gray-50 to-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Vos objectifs de
                        <span class="text-gradient bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">transformation</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Sélectionnez ce qui vous correspond le mieux et commencez votre transformation dès aujourd'hui
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="goalsGrid">
                    <!-- Goals will be loaded here -->
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="py-20 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    Prêt à transformer votre vie ?
                </h2>
                <p class="text-xl mb-8 opacity-90">
                    Rejoignez des milliers d'utilisateurs qui ont déjà atteint leurs objectifs
                </p>
                <button id="ctaBtn" class="bg-white text-blue-600 px-12 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition duration-200 flex items-center mx-auto">
                    <i class="fas fa-arrow-right mr-3"></i>
                    Commencer gratuitement
                </button>
            </div>
        </div>

        <!-- Auth Modal -->
        <div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-2xl p-8 max-w-md w-full shadow-2xl">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-800" id="authTitle">Se connecter</h3>
                        <button id="closeAuthModal" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                    </div>

                    <!-- Switch Tabs -->
                    <div class="relative bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-1 mb-8 border border-gray-200">
                        <div class="flex relative">
                            <button id="loginTab" class="flex-1 py-3 px-6 rounded-xl font-semibold transition-all duration-300 bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg transform scale-105 z-10">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Connexion
                            </button>
                            <button id="registerTab" class="flex-1 py-3 px-6 rounded-xl font-semibold transition-all duration-300 text-gray-600 hover:text-gray-800 hover:bg-white/50">
                                <i class="fas fa-user-plus mr-2"></i>
                                Inscription
                            </button>
                        </div>
                    </div>

                    <!-- Login Form -->
                    <form id="loginForm" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Indicatif pays</label>
                            <select id="loginCountryCode" class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="221">🇸🇳 Sénégal (+221)</option>
                                <option value="33">🇫🇷 France (+33)</option>
                                <option value="245">🇬🇳 Guinée (+245)</option>
                                <option value="225">🇨🇮 Côte d'Ivoire (+225)</option>
                                <option value="237">🇨🇲 Cameroun (+237)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
                            <input type="tel" id="loginPhone" class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ex: 123456789">
                        </div>

                        <button type="submit" class="w-full btn-primary text-white py-4 rounded-xl font-medium transition duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Continuer
                        </button>
                    </form>

                    <!-- Register Form -->
                    <form id="registerForm" class="space-y-6 hidden">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                                <input type="text" id="firstName" class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                                <input type="text" id="lastName" class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Indicatif pays</label>
                            <select id="registerCountryCode" class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="221">🇸🇳 Sénégal (+221)</option>
                                <option value="33">🇫🇷 France (+33)</option>
                                <option value="245">🇬🇳 Guinée (+245)</option>
                                <option value="225">🇨🇮 Côte d'Ivoire (+225)</option>
                                <option value="237">🇨🇲 Cameroun (+237)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Numéro de téléphone</label>
                            <input type="tel" id="registerPhone" class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ex: 123456789" required>
                        </div>

                        <button type="submit" class="w-full btn-secondary text-white py-4 rounded-xl font-medium transition duration-200">
                            <i class="fas fa-user-plus mr-2"></i>
                            Créer mon compte
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- User Verification Modal -->
        <div id="userVerificationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-2xl p-8 max-w-md w-full text-center shadow-2xl">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-user-check text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Confirmer votre identité</h3>
                    <p class="text-gray-600 mb-8" id="userInfo"></p>

                    <div class="space-y-4">
                        <button id="confirmUser" class="w-full btn-secondary text-white py-4 rounded-xl font-medium transition duration-200">
                            <i class="fas fa-check mr-2"></i>
                            Oui, c'est moi
                        </button>
                        <button id="cancelVerification" class="w-full bg-gray-300 text-gray-700 py-4 rounded-xl font-medium hover:bg-gray-400 transition duration-200">
                            <i class="fas fa-times mr-2"></i>
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
            document.getElementById('loginBtn').addEventListener('click', () => showModal('authModal'));
            document.getElementById('closeAuthModal').addEventListener('click', () => hideModal('authModal'));
            document.getElementById('startBtn').addEventListener('click', () => {
                showModal('authModal');
                switchToRegister();
            });
            document.getElementById('ctaBtn').addEventListener('click', () => {
                showModal('authModal');
                switchToRegister();
            });

            // Tab switching functionality
            function switchToLogin() {
                document.getElementById('authTitle').textContent = 'Se connecter';
                document.getElementById('loginForm').classList.remove('hidden');
                document.getElementById('registerForm').classList.add('hidden');
                document.getElementById('loginTab').classList.add('bg-white', 'text-blue-600', 'shadow-sm');
                document.getElementById('loginTab').classList.remove('text-gray-600', 'hover:text-gray-800');
                document.getElementById('registerTab').classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
                document.getElementById('registerTab').classList.add('text-gray-600', 'hover:text-gray-800');
            }

            function switchToRegister() {
                document.getElementById('authTitle').textContent = 'S\'inscrire';
                document.getElementById('loginForm').classList.add('hidden');
                document.getElementById('registerForm').classList.remove('hidden');
                document.getElementById('registerTab').classList.add('bg-white', 'text-blue-600', 'shadow-sm');
                document.getElementById('registerTab').classList.remove('text-gray-600', 'hover:text-gray-800');
                document.getElementById('loginTab').classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
                document.getElementById('loginTab').classList.add('text-gray-600', 'hover:text-gray-800');
            }

            document.getElementById('loginTab').addEventListener('click', switchToLogin);
            document.getElementById('registerTab').addEventListener('click', switchToRegister);

            // Close modals when clicking outside
            document.querySelectorAll('[id$="Modal"]').forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        hideModal(modal.id);
                    }
                });
            });

            // Load goals with enhanced design
            fetch('/goals')
                .then(response => response.json())
                .then(data => {
                    const goalsGrid = document.getElementById('goalsGrid');
                    const gradientClasses = [
                        'from-red-500 to-pink-500',
                        'from-blue-500 to-indigo-500',
                        'from-green-500 to-emerald-500',
                        'from-purple-500 to-pink-500',
                        'from-yellow-500 to-orange-500',
                        'from-teal-500 to-cyan-500'
                    ];

                    data.goals.forEach((goal, index) => {
                        const gradientClass = gradientClasses[index % gradientClasses.length];
                        const goalCard = document.createElement('div');
                        goalCard.className = 'card-hover bg-white p-8 rounded-2xl shadow-xl border cursor-pointer group';
                        goalCard.innerHTML = `
                            <div class="text-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br ${gradientClass} rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <span class="text-2xl">${goal.icon}</span>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold mb-4 text-center text-gray-800">${goal.name}</h3>
                            <p class="text-gray-600 text-center leading-relaxed">${goal.description}</p>
                            <div class="mt-6 text-center">
                                <button class="bg-gradient-to-r ${gradientClass} text-white px-6 py-2 rounded-full text-sm font-medium hover:shadow-lg transition-all duration-200">
                                    Choisir cet objectif
                                </button>
                            </div>
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
                        hideModal('authModal');
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
                        hideModal('authModal');
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
