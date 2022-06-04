<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    use HasFactory;

    protected $table = 'customer_contact';

    protected $fillable = [
        'nome_contact',
        'cpf',
        'email_contact',
    ];

    public $timestamps = false;

    public function customerContact()
    {
        return $this->belongsTo('App\Models\Customer', 'id_customer', 'id');
    }
}
