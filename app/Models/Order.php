<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id', 'nom_client', 'adresse_livraison', 
        'statut_livraison', 'visible'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
