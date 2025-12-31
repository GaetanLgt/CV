# Portfolio 3D - Vue 3 + TresJS + GSAP

Portfolio 3D moderne inspiré de JavaScript Mastery, construit avec Vue 3, TresJS (Three.js), GSAP, et Symfony 7 + API Platform en backend.

## 🎯 Fonctionnalités

- **Hero 3D** avec animation Three.js (TresJS)
- **Navbar collante** avec animations GSAP
- **Showcase projets** avec grille responsive
- **Logo showcase** avec défilement infini
- **Feature cards** animées au scroll
- **Timeline expérience** professionnelle
- **Tech stack** avec barres de progression animées
- **Témoignages** de clients
- **Formulaire de contact** avec EmailJS
- **Footer** complet avec liens sociaux

## 📦 Stack Technique

### Frontend
- **Vue 3** - Framework JavaScript progressif
- **Vite** - Build tool ultra-rapide
- **@tresjs/core** - Three.js pour Vue
- **@tresjs/cientos** - Composants 3D helpers
- **GSAP** - Animations haute performance
- **Tailwind CSS** - Framework CSS utility-first

### Backend
- **Symfony 7** - Framework PHP
- **API Platform 3** - Framework API REST/GraphQL
- **PostgreSQL 16** - Base de données
- **Doctrine ORM** - Mapping objet-relationnel

### DevOps
- **Docker** - Containerisation
- **Docker Compose** - Orchestration multi-conteneurs
- **Nginx** - Reverse proxy

## 🚀 Installation & Lancement

### Prérequis

- Docker & Docker Compose
- Node.js 20+ (pour le développement local)
- Composer (pour le développement local)

### 1. Installation

```bash
# Cloner le repository
git clone <repository-url>
cd CV
```

### 2. Configuration Backend

```bash
# Le fichier .env.local est déjà configuré
# Vérifier les variables si nécessaire
cat backend/.env.local
```

### 3. Build & Démarrage avec Docker

```bash
# Build le frontend
docker compose run --rm node

# Démarrer tous les services
docker compose up -d --build

# Installer les dépendances PHP
docker compose exec php composer install

# Créer la base de données et exécuter les migrations
docker compose exec php php bin/console doctrine:database:create --if-not-exists
docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction
```

### 4. Accès à l'application

- **Frontend**: http://localhost:8080
- **API**: http://localhost:8080/api
- **API Docs**: http://localhost:8080/api/docs

## 🗂️ Structure du Projet

```
portfolio-3d/
├── frontend/                 # Application Vue 3
│   ├── src/
│   │   ├── components/      # Composants Vue
│   │   │   ├── Hero3D.vue
│   │   │   ├── Navbar.vue
│   │   │   ├── Showcase.vue
│   │   │   ├── LogoShowcase.vue
│   │   │   ├── FeatureCards.vue
│   │   │   ├── Timeline.vue
│   │   │   ├── TechStack.vue
│   │   │   ├── Testimonials.vue
│   │   │   ├── Contact.vue
│   │   │   └── Footer.vue
│   │   ├── App.vue          # Composant racine
│   │   ├── main.js          # Point d'entrée
│   │   └── style.css        # Styles globaux
│   ├── index.html
│   ├── package.json
│   ├── vite.config.js
│   └── tailwind.config.js
│
├── backend/                  # API Symfony
│   ├── src/
│   │   ├── Entity/          # Entités Doctrine
│   │   │   ├── Project.php
│   │   │   ├── Experience.php
│   │   │   └── Testimonial.php
│   │   └── Repository/      # Repositories
│   ├── config/              # Configuration
│   ├── public/              # Point d'entrée web
│   └── composer.json
│
├── docker/                   # Configuration Docker
│   ├── nginx.conf
│   └── php.Dockerfile
│
└── docker-compose.yml        # Orchestration Docker
```

## 📝 Entités API Platform

### Project
- `title`: Titre du projet
- `slug`: URL-friendly identifier
- `description`: Description détaillée
- `url`: Lien vers le projet
- `tags`: Technologies utilisées
- `featured`: Projet mis en avant
- `cover`: Image de couverture
- `position`: Ordre d'affichage

### Experience
- `company`: Nom de l'entreprise
- `position`: Poste occupé
- `startDate`: Date de début
- `endDate`: Date de fin (nullable si en cours)
- `description`: Description du poste
- `technologies`: Technologies utilisées
- `logo`: Logo de l'entreprise
- `current`: Poste actuel

### Testimonial
- `name`: Nom du client
- `position`: Poste du client
- `company`: Entreprise du client
- `content`: Contenu du témoignage
- `avatar`: Photo du client
- `rating`: Note sur 5

## 🎨 Personnalisation

### Couleurs (Tailwind)

Modifier `frontend/tailwind.config.js`:

```js
colors: {
  primary: '#0F172A',    // Fond principal
  secondary: '#1E293B',  // Fond secondaire
  accent: '#3B82F6',     // Couleur d'accent
}
```

### Animations GSAP

Tous les composants utilisent GSAP avec ScrollTrigger pour les animations au scroll. Ajuster dans chaque composant:

```js
gsap.from(element, {
  scrollTrigger: {
    trigger: element,
    start: 'top 80%',  // Ajuster le point de déclenchement
  },
  // ... propriétés d'animation
})
```

## 📧 Configuration EmailJS

1. Créer un compte sur [EmailJS](https://www.emailjs.com/)
2. Créer un service email
3. Créer un template
4. Modifier `frontend/src/components/Contact.vue`:

```js
// Décommenter et configurer
emailjs.init('YOUR_PUBLIC_KEY')

await emailjs.send(
  'YOUR_SERVICE_ID',
  'YOUR_TEMPLATE_ID',
  { ... },
  'YOUR_PUBLIC_KEY'
)
```

## 🔄 Commandes Utiles

### Frontend (développement local)
```bash
cd frontend
npm install
npm run dev        # Serveur de dev Vite
npm run build      # Build production
```

### Backend
```bash
# Créer une nouvelle entité
docker compose exec php php bin/console make:entity

# Créer une migration
docker compose exec php php bin/console make:migration

# Exécuter les migrations
docker compose exec php php bin/console doctrine:migrations:migrate

# Vider le cache
docker compose exec php php bin/console cache:clear
```

### Docker
```bash
# Voir les logs
docker compose logs -f

# Arrêter les services
docker compose down

# Rebuild complet
docker compose down -v
docker compose up -d --build
```

## 🌐 Déploiement

### Production

1. **Frontend**: Build et servir avec Nginx
2. **Backend**: Configurer les variables d'environnement
3. **Base de données**: Utiliser PostgreSQL managé
4. **HTTPS**: Configurer SSL/TLS avec Let's Encrypt

### Variables d'environnement de production

```env
# backend/.env.local
APP_ENV=prod
APP_SECRET=<générer-avec-openssl-rand-hex-32>
DATABASE_URL=postgresql://user:pass@host:5432/dbname
CORS_ALLOW_ORIGIN='^https://your-domain.com$'
```

## 🎯 Prochaines Étapes

- [ ] Ajouter des données de démonstration (fixtures)
- [ ] Implémenter l'authentification admin
- [ ] Ajouter un panel d'administration
- [ ] Optimiser les images (lazy loading)
- [ ] Ajouter des tests unitaires
- [ ] Mettre en place CI/CD
- [ ] Ajouter Google Analytics
- [ ] Optimiser SEO

## 📄 Licence

MIT

## 👤 Auteur

**Gaëtan LANGLET**

- Portfolio: [gaetan-langlet.fr](https://gaetan-langlet.fr)
- GitHub: [@GaetanLgt](https://github.com/GaetanLgt)

---

**Fait avec ❤️ en Vue 3 + TresJS + GSAP**
