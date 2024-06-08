<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sujet extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = ["numero", "titre", "description", "mot_cle", "niveau"];
}
