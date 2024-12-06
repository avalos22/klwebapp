<?php

namespace App\Livewire;

use Livewire\Component;
// use App\Models\Service;
use App\Models\BusinessDirectory;

class ServiceForm extends Component
{
    public $customer;
    public $rate_to_customer;
    public $currency = 'USD'; // Moneda predeterminada
    public $billing_currency_reference;
    public $pickup_number;
    public $shipment_status;

    public $customers; // Lista de clientes
    public $suppliers; // Lista de proveedores
    public $stations; // Lista de estaciones

    public $selectedCustomer;
    
    public function mount()
    {
        // Filtrar los datos por type en la tabla business_directories desde el modelo BusinessDirectory
        $this->customers = BusinessDirectory::byType('customer')->get(); // Asegúrate que esto devuelva una colección
        $this->suppliers = BusinessDirectory::byType('supplier')->get(); 
        $this->stations = BusinessDirectory::byType('station')->get();
    }


    public function updatedCustomer($customerId)
    {
        $this->selectedCustomer = BusinessDirectory::find($customerId);
    }

    public function render()
    {
        return view('services.service-form');
    }

    public function refreshPreview()
    {
        // Esto solo asegura que se refresque el componente.
    }

}
