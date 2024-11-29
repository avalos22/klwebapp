<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDirectory extends Model
{
    use HasFactory;
    protected $table = 'business_directories';

    protected $fillable = [
        'type', 
        'company', 
        'nickname', 
        'billing_currency', 
        'rfc_tax_id', 
        'street_address', 
        'building_number', 
        'neighborhood', 
        'city', 
        'state', 
        'postal_code', 
        'country', 
        'phone', 
        'website', 
        'email', 
        'credit_days', 
        'credit_expiration_date', 
        'free_loading_unloading_hours', 
        'factory_company_id',
        'notes', 
        'add_document', 
        'document_expiration_date', 
        'picture', 
        'tarifario'
    ];
}
