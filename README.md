<<<<<<< HEAD
# Vibe Social - Extension de Fonctionnalités Sociales

## 📱 À propos

Vibe Social est une extension de l'application Vibe qui transforme la plateforme en un véritable réseau social. Cette nouvelle version permet aux utilisateurs d'ajouter des amis, de publier du contenu, d'interagir avec les publications des autres, et de profiter d'un fil d'actualités dynamique et interactif.

## ✨ Fonctionnalités

### Gestion des Relations
- **Système d'Amis** - Envoi, acceptation et refus de demandes d'amis
- **Liste d'Amis** - Affichage et gestion des connexions
- **Consultation de Profils** - Accès aux profils utilisateurs avec leurs publications et interactions

### Partage de Contenu
- **Publications** - Création de posts incluant texte et images
- **Modification et Suppression** - Gestion complète du contenu publié
- **Fil d'Actualités** - Affichage chronologique des publications des amis

### Interactions
- **Likes** - Ajout de likes aux publications avec compteur
- **Commentaires** - Possibilité de commenter les publications
- **Affichage Chronologique** - Tri des publications du plus récent au plus ancien

### Fonctionnalités Avancées (Bonus)
- **Notifications en Temps Réel** - Alertes pour les demandes d'amis et interactions
- **Système de Partage** - Diffusion des publications à travers le réseau
- **Pagination Infinie** - Chargement progressif du fil d'actualités
- **Hashtags** - Organisation et découverte de contenu via mots-clés

## 🚀 Installation

```bash
# Cloner le repository
git clone https://github.com/votre-username/vibe-social.git

# Se déplacer dans le répertoire
cd vibe-social

# Installer les dépendances PHP
composer install

# Installer les dépendances JavaScript
npm install

# Copier le fichier d'environnement
cp .env.example .env

# Générer la clé d'application
php artisan key:generate

# Configurer la base de données dans .env puis migrer
php artisan migrate

# Compiler les assets
npm run dev

# Démarrer le serveur de développement
php artisan serve
```

## 💻 Technologies Utilisées

- **Backend**: PHP 8.x, Laravel 10.x
- **Frontend**: Livewire, Alpine.js, Tailwind CSS
- **Base de données**: Postgresql
- **Temps réel**: Laravel Echo, Pusher
- **Authentification**: Laravel Fortify/Jetstream

## 📐 Architecture

Le projet suit l'architecture MVC de Laravel avec:
- **Models** - Définition des entités et relations
- **Controllers** - Logique métier
- **Views** - Templates Blade
- **Livewire Components** - Composants réactifs sans JavaScript complexe
- **Migrations** - Gestion de la structure de la base de données

## 🛠️ Développement

### Structure du Projet

```
vibe-social/
├── app/                        # Code de l'application
│   ├── Http/                   # Controllers, Middleware, Requests
│   │   ├── Controllers/        # Controllers Laravel
│   │   └── Livewire/           # Composants Livewire
│   ├── Models/                 # Modèles Eloquent
│   └── Providers/              # Service Providers
│
├── database/                   # Migrations et Seeds
│   ├── migrations/             # Migrations de base de données
│   └── seeders/                # Seeders pour les données initiales
│
├── resources/                  # Assets frontend
│   ├── css/                    # Fichiers CSS/SCSS
│   ├── js/                     # JavaScript
│   └── views/                  # Templates Blade et composants
│       ├── components/         # Composants Blade
│       ├── layouts/            # Layouts réutilisables
│       └── livewire/           # Templates de composants Livewire
│
├── routes/                     # Définition des routes
│   ├── web.php                 # Routes web
│   └── api.php                 # Routes API (si nécessaire)
│
└── README.md                   # Documentation
```

## 🔄 Temps Réel

Les fonctionnalités en temps réel sont implémentées avec:
- Laravel Echo pour le client JavaScript
- Laravel Websockets ou Pusher pour le backend
- Livewire pour les mises à jour automatiques de composants

## 🔐 Authentification et Autorisation

- Utilisation des policies Laravel pour gérer les permissions
- Gestion des rôles et droits d'accès par middleware
- Protection CSRF automatique via Laravel

## 📝 Contribution

1. Forker le projet
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature/amazing-feature`)
3. Commiter vos changements (`git commit -m 'feat: Ajouter une fonctionnalité incroyable'`)
4. Pousser vers la branche (`git push origin feature/amazing-feature`)
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus d'informations.

## 👥 Équipe

- TBIBZAT CHARAF EDDINE - Chef de Projet & Développeur

=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> 070ee08 (initialisation de projet and add use case)
