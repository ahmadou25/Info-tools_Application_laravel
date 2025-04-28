<x-app-layout>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f8fafc;
            }

            .hero-section {
                background: linear-gradient(135deg, #1e3a8a, #3b82f6);
                padding: 5rem 2rem;
                color: white;
                border-radius: 1rem;
                margin-bottom: 2rem;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
                position: relative;
                overflow: hidden;
            }

            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom center;
                background-size: cover;
            }

            .hero-title {
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                position: relative;
            }

            .hero-subtitle {
                font-size: 1.25rem;
                opacity: 0.9;
                font-weight: 400;
                position: relative;
                max-width: 600px;
                margin: 0 auto;
            }

            .feature-card {
                background: white;
                border-radius: 0.75rem;
                padding: 1.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                border: 1px solid #e2e8f0;
                height: 100%;
            }

            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                border-color: #bfdbfe;
            }

            .feature-icon {
                width: 3rem;
                height: 3rem;
                border-radius: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1rem;
            }

            .feature-title {
                font-size: 1.125rem;
                font-weight: 600;
                color: #1e293b;
                margin-bottom: 0.5rem;
            }

            .feature-description {
                color: #64748b;
                font-size: 0.875rem;
                margin-bottom: 1rem;
            }

            .feature-link {
                display: inline-flex;
                align-items: center;
                color: #3b82f6;
                font-weight: 500;
                font-size: 0.875rem;
                transition: color 0.2s;
            }

            .feature-link:hover {
                color: #2563eb;
            }

            .feature-link svg {
                margin-left: 0.25rem;
                transition: transform 0.2s;
            }

            .feature-link:hover svg {
                transform: translateX(2px);
            }

            footer {
                background-color: #1e293b;
                color: white;
                padding: 3rem 0;
                margin-top: 4rem;
            }

            .footer-links {
                display: flex;
                justify-content: center;
                gap: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .footer-link {
                color: #94a3b8;
                transition: color 0.2s;
            }

            .footer-link:hover {
                color: white;
                text-decoration: underline;
            }

            .footer-copyright {
                color: #94a3b8;
                font-size: 0.875rem;
            }
        </style>
    </head>

    <div class="min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Hero Section -->
            <section class="hero-section text-center">
                <div class="relative z-10">
                    <h1 class="hero-title">Plateforme CRM INFO-TOOLS</h1>
                    <p class="hero-subtitle">L'outil professionnel pour gérer votre relation client et optimiser vos ventes</p>
                </div>
            </section>

            <!-- Notification de succès -->
            @if(session('success'))
                <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-green-700">{{ session('success') }}</div>
                </div>
            @endif

            <!-- Cartes de fonctionnalités -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Clients -->
                <a href="{{ route('clients.index') }}" class="feature-card">
                    <div class="feature-icon bg-indigo-100">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Gestion des Clients</h3>
                    <p class="feature-description">Consultez et gérez votre portefeuille clients</p>
                    <span class="feature-link">
                        Accéder
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </a>

                <!-- Rendez-vous -->
                <a href="{{ route('appointments.index') }}" class="feature-card">
                    <div class="feature-icon bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Rendez-vous</h3>
                    <p class="feature-description">Planifiez et suivez vos rencontres commerciales</p>
                    <span class="feature-link">
                        Accéder
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </a>

                <!-- Produits -->
                <a href="{{ route('products.index') }}" class="feature-card">
                    <div class="feature-icon bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Gestion des Produits</h3>
                    <p class="feature-description">Consultez et gérez votre catalogue produits</p>
                    <span class="feature-link">
                        Accéder
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </a>

                <!-- Commandes -->
                <a href="{{ route('orders.index') }}" class="feature-card">
                    <div class="feature-icon bg-purple-100">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Commandes</h3>
                    <p class="feature-description">Suivez et traitez les commandes clients</p>
                    <span class="feature-link">
                        Accéder
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </a>

                <!-- Factures -->
                <a href="{{ route('invoices.index') }}" class="feature-card">
                    <div class="feature-icon bg-red-100">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>
                        </svg>
                    </div>
                    <h3 class="feature-title">Factures</h3>
                    <p class="feature-description">Générez et consultez vos factures</p>
                    <span class="feature-link">
                        Accéder
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </a>

                <!-- Gestion des commerciaux -->
                @if(!Auth::user()->hasRole('Salesperson'))
                    <a href="{{ route('users.index') }}" class="feature-card">
                        <div class="feature-icon bg-amber-100">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="feature-title">Équipe Commerciale</h3>
                        <p class="feature-description">Gérez vos commerciaux et leurs performances</p>
                        <span class="feature-link">
                            Accéder
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </a>
                @endif
            </div>
        </div>
       
        <!-- <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="Photo de profil" class="rounded-full h-20 w-20"> -->

        <!-- Footer -->
        <footer>
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="footer-links">
                    <a href="#" class="footer-link">Mentions légales</a>
                    <a href="#" class="footer-link">Conditions d'utilisation</a>
                    <a href="#" class="footer-link">Politique de confidentialité</a>
                    <a href="#" class="footer-link">Contact</a>
                </div>
                <p class="footer-copyright text-center">&copy; {{ date('Y') }} INFO-TOOLS CRM. Tous droits réservés.</p>
            </div>
        </footer>
    </div>
</x-app-layout>