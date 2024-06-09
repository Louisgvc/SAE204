# SAE 204

## 6-Gestion des projets tuteurés

Objectif :

L’organisation des projets tuteurés dans le département Réseaux et Télécoms est assez laborieuse (!).
L’enseignant responsable demande à ses collègues des sujets, les fusionne puis les propose aux étudiants.
Les étudiants remplissent les fiches de vœux. Le responsable des projets regroupe ses fiches de vœux dans
un tableur puis le logiciel d’attribution distribue les sujets et propose les combinaisons.
L’idée est de réaliser un site web sur lequel les enseignants déposeront leurs sujets qui seront validés par
l’administrateur. Ensuite les étudiants auront quelques jours pour faire leurs vœux. L’algorithme
d’optimisation actuellement utilisé sera repris [attribution de projets](https://jb.vioix.fr/attribution-de-projets/). A l’issue de ce
processus, l’administrateur réglera les cas équivalents.

---

### SQL/BBD

- Premiere page :
    - BBD -> Admin/Profs/Etudiants
- BBD Sujet
    - BBD -> Sujet profs / etudiants , Sujet (Idee)      


### Domaine de compétences : Informatique


3 types de profils :

- Admin :
    - définit les dates limites
       - dépôt de sujets pour les enseignants option comme brouillons (vue que par l'enseignats)  
       - voeux des étudiants
    - approuve les sujets proposés par les enseignants et les publie sur le site
    - lance l'attribution des sujets aux étudiants et publie les résultats

- Profs : proposent des sujets avec
   - titre
   - description
   - mots-clés (domaine de compétences)
   - niveau de difficulté

- Etudiants
  - Permission :
    - envoyer requete a son binome mail
    - trier sujet par ordre de preference
        - Se connecter avec leurs identifiants sur le site
        - Choisir son binôme
        - Faire une demande de sujet au binome, qui devra être approuvée par le binôme
        - Choisir 5 sujets dans la liste et les classer par ordre de preference
        - Attendre la validation des 2/3 etudiants sur l'attribution des sujets et de l'odre.
     

Choisier un etudiant dans une liste déroulante, puis les ajoute dans un groupe {a...z}

```sql
Select u.nom, u.prenom from users u
inner join roles r
where r.nom = "etudiant";
```

```php

<?php
$str = "Shannon2";
$pattern = "/Shannon.*/"; 
echo preg_match($pattern, $str);
if 
?>

```
---

# Tips 

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Install laravel with mysql
```
composer create-project laravel/laravel example-app
```

```
cd example-app
 
php artisan serve
```
### Change file .env

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:Qz7...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

```
php artisan migrate
```

## Install Backpack

```
composer require backpack/crud
```

```
php artisan backpack:install
```
---

### Exemple de creation d'une page Sujet

```
php artisan make:model Sujet -m
```
Aller dans Sujet.php et ajouter cet ligne

```
protected $fillable = ["numero", "titre", "description", "mot_cle", "niveau"];

```
Aller dans database/migrations

puis ajouter le descriptif de la page voulu

```
Schema::create('sujets', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->string('titre');
            $table->longText('description');
            $table->string("mot_cle");
            $table->enum("niveau",["facile", "moyen","difficile", "expert"]);
            $table->timestamps();
        });
```

```
php artisan migrate

php artisan backpack:crud Sujet

php artisan backpack:build

```
dans SujetCrudController
```
  CRUD::field("numero")->label("Numero de sujet")->type("text");
        CRUD::field("titre")->label("Titre")->type("text");
        CRUD::field("description")->label("Description")->type("textarea");
        CRUD::field("mot_cle")->label("Mot cle")->type("text");
        CRUD::field("niveau")->label("Niveau")->type("select_from_array")
            ->options([
                "facile" => "Facile",
                "moyen" => "Moyen",
                "difficile" => "Difficile",
                "expert" => "Expert"
            ]);

```


