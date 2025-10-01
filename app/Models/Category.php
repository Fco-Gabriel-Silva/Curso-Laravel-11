<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Caso queira modificar o nome da tabela: 
    // protected $table = 'categorias'; // Exemplo traduzindo o nome da tabela em português
}
