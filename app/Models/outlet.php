<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class outlet extends Model
{
    protected $fillable = [
        'nama',
        'alamat'
    ];

    protected $table = 'outlet';
    
    public function paket(){
        return $this->hasMany(paket::class, 'id_outlet');
    }
}
