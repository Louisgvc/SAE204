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

### Sujet
```
php artisan make:model Sujet -m
```

Aller dans database/migrations

puis ajouter le descriptif de la page voulu

```
Schema::create('sujets', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->string('numero')->unique(); 
            $table->string('keywords')->nullable(); //mots-clés
            $table->enum('difficulter', ['debutant', 'facile', 'modere', 'difficile', 'extreme']);
            $table->timestamps();
        });
```

```
php artisan migrate

php artisan backpack:crud sujet

```

dans SujetCrudController
```
        $this->crud->setValidation(\App\Http\Requests\SujetRequest::class);

        $this->crud->addField([
            'name' => 'numero',
            'type' => 'text',
            'label' => 'Numéro de Sujet',
        ]);
        $this->crud->addField([
            'name' => 'titre',
            'type' => 'text',
            'label' => 'Titre',
        ]);
        $this->crud->addField([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'description',
        ]);
        $this->crud->addField([
            'name' => 'keywords',
            'type' => 'text',
            'label' => 'Mots-clés',
        ]);
        $this->crud->addField([
            'name' => 'difficulter',
            'type' => 'enum',
            'label' => 'Niveau de Difficulté',
            'options' => ['debutant', 'facile', 'modere', 'difficile', 'extreme'], // Options pour le niveau de difficulté
            'allows_null' => true,
        ]);


```
Puis dans SujetController

```
lass SujetController extends Controller
{
    public function index()
    {
        $sujets = Sujet::all();
        return view('sujets.index', compact('sujets'));
    }

    public function show($id)
    {
        $sujet = Sujet::findOrFail($id);
        return view('sujets.show', compact('sujet'));
    }
}
```
Maintenant faire 2 fichiers dans resources/sujets

index.blade.php : 
```
@extends('layouts.app')

@section('content')
    <h1>Sujets</h1>
    <ul>
        @foreach ($sujets as $sujet)
            <li>
                <a href="{{ route('sujets.show', $sujet->id) }}">{{ $sujet->numero }} - {{ $sujet->titre }}</a>
                <p>{{ $sujet->keywords }}</p>
                <p>{{ $sujet->difficulter }}</p>
            </li>
        @endforeach
    </ul>
@endsection
```
show.blade.php : 
```
@extends('layouts.app')

@section('content')
    <h1>{{ $sujet->numero }} - {{ $sujet->titre }}</h1>
    <p>{{ $sujet->description }}</p>
    <p><strong>Mots-clés:</strong> {{ $sujet->keywords }}</p>
    <p><strong>Niveau de Difficulté:</strong> {{ $sujet->difficulter }}</p>
    <a href="{{ route('sujets.index') }}">Retour aux Sujets</a>
@endsection
```
Enfain ajout les routes routes/web.php

```
Route::get('/sujets', [SujetController::class, 'index'])->name('sujets.index');
Route::get('/sujets/{id}', [SujetController::class, 'show'])->name('sujets.show');
```


