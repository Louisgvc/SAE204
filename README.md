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
    - Se connecter avec leurs identifiants sur le site
    - Choisir son binôme
    - envoyer requete mail/notification pour demand de binome ou trinome
    - Faire une demande de sujet au binome, qui devra être approuvée par le binôme
    - Choisir 5 sujets dans la liste et les classer par ordre de preference
        - trier sujet par ordre de preference
        - Attendre la validation des 2/3 etudiants sur l'attribution des sujets et de l'odre.
    
    
   
   
   
     

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
### Liste déroulante avec base de données
Créer une table et la définir
```
php artisan make:migration create_groups_table
```
Définir la base de données ainsi :
```
<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('binome1');
            $table->string('binome2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
```

Faire la migration
```
php artisan migrate
```

Dans le modèle (ici app\Models\Group.php)
Définir les champs que l'on ne peut pas modifier avec protected $guarded.
Définir les champs que l'on peut modifier avec protected $fillable.
```
class Group extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'groups';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['binome1','binome2'];
```

Créer le crud controller
```
php artisan backpack:crud group
```
Dans le fichier GroupCrudController
Ajouter les colonnes dans la fonction setupListOperation
```
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
        CRUD::column('binome1');
        CRUD::column('binome2');
    }
```

Dans la fonction setupCreateOperation définir :
```
    protected function setupCreateOperation()
    {
        CRUD::setValidation(GroupRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
        $etudiants = User::pluck('name','name')->toArray();

        CRUD::setValidation(GroupRequest::class);
        CRUD::field('binome1')->label('Choisissez votre nom')->type('select_from_array')->options($etudiants);
        CRUD::field('binome2')->label('Choisissez votre binome')->type('select_from_array')->options($etudiants);
    }
```

Dans le fichier GroupRequest.php : 

```
    public function rules()
    {
        return [
            'binome1' => [
                'required', 
                Rule::unique('groups','binome1')->where(function ($query) {
                    return $query->where('binome1', $this->binome1)
                                ->orWhere('binome2', $this->binome1);
            })],
            'binome2' => [
                'required', 
                Rule::unique('groups','binome2')->where(function ($query) {
                    return $query->where('binome1', $this->binome2)
                                ->orWhere('binome2', $this->binome2);
            })]
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'binome1' => 'premier partenaire',
            'binome2' => 'deuxieme partenaire'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'binome1.unique' => "Cet utilisateur fait déjà partie d'un groupe.",
            'binome2.unique' => "Cet utilisateur fait déjà partie d'un groupe."
        ];
    }
}
```

### GroupRequest.php
```
<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $groupId = $this->route('group');
        $loginUser = auth()->user()->name;

        return [
            'binome1' => [
                'required', 
                Rule::unique('groups','binome1')->where(function ($query) {
                    return $query->where('binome1', $this->binome1)
                                ->orWhere('binome2', $this->binome1);
            })],
            'binome2' => [
                'required', 
                Rule::unique('groups', 'binome1')->ignore($groupId), 
                Rule::unique('groups', 'binome2')->ignore($groupId),
                Rule::unique('groups', 'binome1')->ignore($loginUser),
                Rule::unique('groups', 'trinome')->ignore($groupId)
            ],
            'trinome' => [
                'different:binome2',
                Rule::unique('groups', 'binome1')->ignore($groupId), 
                Rule::unique('groups', 'binome2')->ignore($groupId),
                Rule::unique('groups', 'trinome')->ignore($groupId)
            ]
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'binome1' => 'premier partenaire',
            'binome2' => 'deuxieme partenaire',
            'trinome' => 'troisième partenaire'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'binome1.unique' => "Cet utilisateur fait déjà partie d'un groupe.",
            'binome2.unique' => "Cet utilisateur fait déjà partie d'un groupe.",
            'trinome.unique' => "Cet utilisateur fait déjà partie d'un groupe."
        ];
    }
}

```

GroupCrudController.php
```
<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\GroupRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GroupCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GroupCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Group::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/group');
        CRUD::setEntityNameStrings('group', 'groups');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
        //CRUD::column('binome1');
        //CRUD::column('binome2');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(GroupRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
        $loginUser = auth()->user()->name;
        $etudiants = User::role('etudiant')->where('name', '!=', $loginUser)->pluck('name', 'name')->toArray();

        CRUD::setValidation(GroupRequest::class);
        CRUD::field('binome1')->label('Votre nom')->type('select_from_array')->options([$loginUser => $loginUser]);
        CRUD::field('binome2')->label('Choisissez votre binome')->type('select_from_array')->options($etudiants);
        CRUD::field('trinome')->label('Choisissez votre trinome (optionnel)')->type('select_from_array')->options($etudiants);

    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}

```


