<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'phone',
        'address',
        'type',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'id', 'id');
    }

    // Define the appointments relationship
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id', 'id');
    }

    // Méthode pour vérifier si un client est de type "prosper"
    public function isProsper()
    {
        return $this->type === 'prosper';
    }

}
