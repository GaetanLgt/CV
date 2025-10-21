# Fixtures - Données de démonstration

Pour ajouter des données de test, vous pouvez utiliser directement l'API Platform ou créer un fichier de fixtures.

## Via API Platform (recommandé pour démarrer)

Accédez à http://localhost:8080/api/docs et utilisez l'interface Swagger pour créer des ressources.

## Exemple de données JSON

### Créer un projet

```bash
curl -X POST http://localhost:8080/api/projects \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Portfolio 3D",
    "slug": "portfolio-3d",
    "description": "Un portfolio moderne avec Vue 3, TresJS et GSAP",
    "url": "https://github.com/user/portfolio-3d",
    "tags": ["Vue.js", "Three.js", "GSAP", "Tailwind"],
    "featured": true,
    "cover": "https://images.unsplash.com/photo-1498050108023-c5249f4df085",
    "position": 1
  }'
```

### Créer une expérience

```bash
curl -X POST http://localhost:8080/api/experiences \
  -H "Content-Type: application/json" \
  -d '{
    "company": "Tech Company",
    "position": "Développeur Full Stack",
    "startDate": "2022-01-01",
    "endDate": null,
    "description": "Développement d'\''applications web modernes",
    "technologies": ["Vue.js", "Symfony", "PostgreSQL"],
    "logo": "https://via.placeholder.com/150",
    "current": true
  }'
```

### Créer un témoignage

```bash
curl -X POST http://localhost:8080/api/testimonials \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Jean Dupont",
    "position": "CEO",
    "company": "StartupXYZ",
    "content": "Excellent travail, très professionnel et à l'\''écoute !",
    "avatar": "https://i.pravatar.cc/150?img=1",
    "rating": 5
  }'
```

## Avec Doctrine Fixtures (optionnel)

```bash
# Installer le bundle
docker compose exec php composer require --dev orm-fixtures

# Créer un fichier de fixtures
docker compose exec php php bin/console make:fixtures

# Charger les fixtures
docker compose exec php php bin/console doctrine:fixtures:load
```
