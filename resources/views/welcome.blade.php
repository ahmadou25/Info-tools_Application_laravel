<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFO-TOOLS | Connexion CRM</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0056b3;
            --secondary-color: #003366;
            --accent-color: #00a0e9;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-color);
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 5rem 0;
            flex: 1;
        }
        
        .hero-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .btn-auth {
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 30px;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }
        
        .btn-outline-light:hover {
            color: var(--primary-color);
            background-color: white;
        }
        
        .features-section {
            padding: 4rem 0;
            background-color: white;
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
        }
        
        .feature-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--secondary-color);
        }
        
        footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 2rem 0;
            font-size: 0.9rem;
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color 0.3s;
            margin: 0 10px;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .auth-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-top: -100px;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .btn-auth {
                display: block;
                width: 80%;
                margin: 10px auto;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-handshake me-2"></i>INFO-TOOLS
            </a>
            <div class="ms-auto">
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Connexion</a>
                <!-- <a href="{{ route('register') }}" class="btn btn-primary">Inscription</a> -->
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="hero-title">Plateforme CRM INFO-TOOLS</h1>
                    <p class="hero-subtitle">L'outil professionnel pour gérer votre relation client et optimiser vos ventes</p>
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-light btn-auth">Se connecter</a>
                        <!-- <a href="{{ route('register') }}" class="btn btn-outline-light btn-auth">Créer un compte</a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="feature-title">Pourquoi choisir notre solution CRM ?</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Augmentez vos ventes</h3>
                    <p>Suivez vos prospects et clients efficacement pour maximiser vos opportunités commerciales.</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="feature-title">Gestion des rendez-vous</h3>
                    <p>Planifiez et suivez vos rendez-vous commerciaux en temps réel, où que vous soyez.</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="feature-title">Accessible partout</h3>
                    <p>Accédez à votre CRM depuis votre ordinateur, tablette ou smartphone.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="feature-title mb-4">À propos d'INFO-TOOLS</h2>
                    <p>Fondée en 2010, INFO-TOOLS est spécialisée dans le développement de solutions logicielles pour les professionnels. Notre équipe d'experts accompagne les entreprises dans leur transformation digitale.</p>
                    <p>Notre solution CRM a été conçue spécifiquement pour répondre aux besoins des équipes commerciales avec une interface intuitive et des fonctionnalités puissantes.</p>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Équipe INFO-TOOLS" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <div class="mb-3">
                <a href="#" class="footer-links">Mentions légales</a>
                <a href="#" class="footer-links">Conditions d'utilisation</a>
                <a href="#" class="footer-links">Contact</a>
            </div>
            <p class="mb-0">&copy; 2023 INFO-TOOLS. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>