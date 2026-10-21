# GeneratePassword
🔗 **Lien de l'application en ligne :** (https://generatorpassword.onrender.com/)

Ce projet est une application web utilitaire développée sous Laravel.

L'outil est autonome, ultra-léger et s'exécute entièrement en mémoire vive.

---

## 🛠️ Fonctionnalités

1. **Générateur de mots de passe** : Une génération de mots de passe avec Majuscule, chiffre et caractère spéciaux en prenant le nombre de caractère demandé
2. **Vérification de force de mot de passe** : Un formulaire sécurisé (`POST`) qui analyse la force d'un mot de passe saisi en direct à l'aide d'un algorithme de découpage textuel natif (vérification de longueur, majuscules, chiffres et caractères spéciaux).

---

## 📐 Choix Architecturaux & Bonnes Pratiques Laravel

Le code respecte l'architecture officielle du framework :
* **Séparation des responsabilités (Assets publics)** : Le design a été isolé dans un fichier dédié `public/css/style.css` et lié proprement grâce au helper natif `{{ asset() }}`.
* **Sécurisation des routes par Expressions Régulières (Regex)** : La route dynamique intègre une contrainte `->where('length', '[0-9]+')` directement dans le fichier de routage afin d'empêcher les injections d'URL.
* **Aucune dépendance externe** : L'outil s'appuie uniquement sur les classes natives de Laravel (`Illuminate\Support\Str`) et les fonctions de base de PHP..

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
