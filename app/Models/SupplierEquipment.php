<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierEquipment extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'equipment', 'description'];

    // Relación con Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
