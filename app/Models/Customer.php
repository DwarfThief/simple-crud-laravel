<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'cnpj',
        'status',
    ];

    public function contact()
    {
        return $this->hasMany('App\Models\CustomerContact', 'id_customer', 'id');
    }
}
