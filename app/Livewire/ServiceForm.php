<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use App\Models\BusinessDirectory;
use App\Models\ShipmentStatus;
use App\Models\ServiceDetail;
use App\Models\HandlingType;
use App\Models\MaterialType;
use App\Models\FreightClass;

class ServiceForm extends Component
{
    public $customer;
    public $rate_to_customer;
    public $currency = 'USD'; // Moneda predeterminada
    public $billing_currency_reference;
    public $pickup_number;

    public $customers; // Lista de clientes
    public $suppliers; // Lista de proveedores
    public $stations; // Lista de estaciones

    public $selectedCustomer;

    public $shipment_status; // ID seleccionado
    public $shipmentStatuses; // Lista de opciones de estados
    public $selectedShipmentStatus; // Estado seleccionado

    public $service_detail_id; // Almacenará el ID del tipo de servicio seleccionado
    public $service_details; // Lista de opciones de tipos de servicio

    public $handling_types; // Lista de tipos de manejo
    public $handling_type; // Tipo de manejo seleccionado

    public $material_type; // ID del material seleccionado
    public $materialTypes; // Lista de materiales

    public $freight_class;
    public $freightClasses;
    
    
    public $expedited = false; // Estado por defecto
    public $hazmat = false; 
    public $team_driver = false; 
    public $round_trip = false; 

    public $un_number;
    public $count;
    public $stackable = false;
    public $weight;
    public $length;
    public $width;
    public $height;
    public $uom_weight;
    public $uom_dimensions;
    public $total_yards;
    public $uom_weight_options;
    public $uom_dimensions_options;

    // public $shippers = [];
    // public $consignees = [];
    // public $stopOffs = [];
    public $shipperStopOffs = [];

    public $consigneeStopOffs = []; // Array for consignee stop-offs
    public $delivery_date_requested;
    public $delivery_time_requested;
    public $consignee_station;

    public $pickup_date;
    public $pickup_time;
    public $delivery_date;
    public $delivery_time;

    public function mount()
    {
        // Filtrar los datos por type en la tabla business_directories desde el modelo BusinessDirectory
        $this->customers = BusinessDirectory::byType('customer')->get(); // Asegúrate que esto devuelva una colección
        $this->suppliers = BusinessDirectory::byType('supplier')->get(); 
        $this->stations = BusinessDirectory::byType('station')->get();
        $this->shipmentStatuses = ShipmentStatus::all();
        $this->service_details = ServiceDetail::all();
        $this->handling_types = HandlingType::all();
        $this->materialTypes = MaterialType::all();
        $this->freightClasses = FreightClass::all();
        $this->uom_weight_options = \App\Models\Uom::where('description', 'Weight Units')->get();
    $this->uom_dimensions_options = \App\Models\Uom::where('description', 'Units of Length')->get();
    }


    public function updatedCustomer($customerId)
    {
        $this->selectedCustomer = BusinessDirectory::find($customerId);
    }

    public function updatedShipmentStatus($statusId)
    {
        $this->selectedShipmentStatus = ShipmentStatus::find($statusId);
    }

    public function addStopOff($role)
    {
        if ($role === 'shipper') {
            $this->shipperStopOffs[] = ['station_id' => null];
        } elseif ($role === 'consignee') {
            $this->consigneeStopOffs[] = ['station_id' => null];
        }
    }

    public function removeStopOff($role, $index)
    {
        if ($role === 'shipper') {
            unset($this->shipperStopOffs[$index]);
            $this->shipperStopOffs = array_values($this->shipperStopOffs); // Reindex array
        } elseif ($role === 'consignee') {
            unset($this->consigneeStopOffs[$index]);
            $this->consigneeStopOffs = array_values($this->consigneeStopOffs); // Reindex array
        }
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
