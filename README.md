# InfoSec Vault & Auditor

Ce projet est une application web utilitaire développée sous Laravel. Elle a été conçue spécifiquement dans le cadre de ma candidature chez **Infomaniak (Suisse)** afin de valider mes bases techniques de manière concrète tout en m'alignant sur les valeurs de l'entreprise : la sécurité, la performance et la souveraineté des données.

L'outil est autonome, ultra-léger et s'exécute entièrement en mémoire vive.

---

## 🛠️ Fonctionnalités

1. **Générateur de clés de chiffrement (Vault Pass)** : Une route dynamique capable de générer des secrets cryptographiques ou des phrases secrètes mémorisables (Passphrases) basées sur la longueur demandée directement au niveau de l'URL (`/secure/{length}`).
2. **Auditeur de force de mot de passe (Security Checker)** : Un formulaire sécurisé (`POST`) qui analyse la robustesse d'un mot de passe saisi en direct à l'aide d'un algorithme de découpage textuel natif (vérification de longueur, majuscules, chiffres et caractères spéciaux).

---

## 📐 Choix Architecturaux & Bonnes Pratiques Laravel

Le code respecte l'architecture officielle du framework :
* **Séparation des responsabilités (Assets publics)** : Le design a été isolé dans un fichier dédié `public/css/style.css` et lié proprement grâce au helper natif `{{ asset() }}`.
* **Sécurisation des routes par Expressions Régulières (Regex)** : La route dynamique intègre une contrainte `->where('length', '[0-9]+')` directement dans le fichier de routage afin d'empêcher les injections d'URL.
* **Aucune dépendance externe** : L'outil s'appuie uniquement sur les classes natives de Laravel (`Illuminate\Support\Str`) et les fonctions de base de PHP, garantissant un démarrage instantané sur n'importe quel environnement (Arch Linux, Ubuntu, etc.) sans modification de fichiers système (`php.ini`).

---

## 🚀 Installation locale

1. Clonez le dépôt :
```bash
git clone https://github.com
cd NOM_DU_REPO
```

2. Installez les dépendances via Composer :
```bash
composer install
```

3. Créez votre fichier d'environnement et générez la clé de l'application :
```bash
cp .env.example .env
php artisan key:generate
```

4. Lancez le serveur local :
```bash
php artisan serve
```
L'application est alors accessible à l'adresse : `http://127.0.0.1:8000`

---

## 🧠 Évolutions prévues (TODO)
* [ ] Migrer le dictionnaire statique de passphrases vers une table de données via l'ORM Eloquent dès la validation du module sur les Bases de Données.
* [ ] Ajouter un script JavaScript natif pour la copie en un clic des clés générées dans le presse-papier.
