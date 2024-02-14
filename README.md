# Simple CRM

## Brève Description
Simple CRM est une solution de gestion de la relation client (CRM) conçue pour le suivi efficace des prospects. Facile à utiliser, il permet aux entreprises de créer des comptes utilisateurs, de gérer des fiches contacts et de suivre les interactions client de manière personnalisée.

## Fonctionnalités (non exhautive)
- **Création de compte utilisateur** : Permet aux utilisateurs de s'inscrire et d'accéder à leur espace personnel.
- **Login/Logout** : Gestion sécurisée des sessions utilisateurs. ( Ajout de listener de mise en cache )
- **Création de fiches contact** : Enregistrez et gérez les informations de contact de vos prospects et clients.
- **Créations d'interactions (suivi client) personnalisés** : Suivez l'historique des interactions avec chaque contact pour une gestion personnalisée de la relation client.
- **Envoi E-mails**: Formulaire de contact

## Technologies Utilisées
- **PHP 8** : Langage de programmation côté serveur.
- **Symfony 7** : Framework PHP pour le développement web.
- **Docker** : Plateforme pour le développement, le déploiement et l'exécution d'applications dans des conteneurs.
- **CI/CD (GitHub Actions)** : Automatisation du processus d'intégration et de déploiement continu.
- **Mailtrap**: Plateforme d'envoi d'emails.

## Installation

### Prérequis
- Docker
- Composer

### Étapes d'installation

- **Clonez le dépôt GitHub du projet :**
git clone https://github.com/votre_nom_utilisateur/Simple-CRM.git

- **Naviguez dans le dossier du projet :**
cd Simple-CRM

- **Installez les dépendances PHP via Composer :**
docker-compose exec php composer install

- **Lancez les migrations pour créer la base de données :**
docker-compose exec php php bin/console doctrine:migrations:migrate

- **Votre instance de Simple CRM devrait maintenant être opérationnelle et accessible via http://localhost.**

### Contribution
Les contributions sont les bienvenues ! Pour contribuer au projet, veuillez forker le dépôt, créer une branche pour votre fonctionnalité ou correction, puis soumettre une pull request.



