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
// use App\Models\ExchangeRate;
// use App\Models\Cargo;
// use App\Models\Shipper;
// use App\Models\Consignee;
// use App\Models\StopOff;
use App\Services\ServiceRegistration;
use App\Services\CargoRegistration;
// use App\Services\ShipperRegistration;
// use App\Services\ConsigneeRegistration;
// use App\Services\StopOffRegistration;

class ServiceForm extends Component
{
    public $customer;
    public $rate_to_customer;
    public $currency = 'USD';
    public $billing_currency_reference;
    public $pickup_number;
    public $customers;
    public $selectedCustomer;
    public $shipment_status;
    // public $shipmentStatuses;
    // public $selectedShipmentStatus;

    public $suppliers;
    public $stations;

    

    

    public $service_detail_id;
    public $service_details;

    public $handling_types;
    public $handling_type;

    public $material_type;
    public $materialTypes;

    public $freight_class;
    public $freightClasses;

    public $expedited = false;
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

    public $shipperStopOffs = [];
    public $consigneeStopOffs = [];
    public $pickup_station;
    public $delivery_date_requested;
    public $delivery_time_requested;
    public $consignee_station;
    public $requested_pickup_date;
    public $pickup_time;
    public $border_crossing_date;

    protected $listeners = [
        'updatePreview' => 'handleUpdatePreview',
        'updateStopOffs' => 'handleUpdateStopOffs',
        'updateCustomerInfo' => 'updateCustomerInfo',
    ];

    public function mount()
    {
        // Filtrar los datos por type en la tabla business_directories desde el modelo BusinessDirectory
        // $this->customers = BusinessDirectory::byType('customer')->get(); // Asegúrate que esto devuelva una colección
        $this->suppliers = BusinessDirectory::byType('supplier')->get(); 
        $this->stations = BusinessDirectory::byType('station')->get();
        // $this->shipmentStatuses = ShipmentStatus::all();
        $this->service_details = ServiceDetail::all();
        $this->handling_types = HandlingType::all();
        $this->materialTypes = MaterialType::all();
        $this->freightClasses = FreightClass::all();
        $this->uom_weight_options = \App\Models\Uom::where('description', 'Weight Units')->get();
        $this->uom_dimensions_options = \App\Models\Uom::where('description', 'Units of Length')->get();
    }


    // public function updatedCustomer($customerId)
    // {
    //     $this->selectedCustomer = BusinessDirectory::find($customerId);
    // }

    // public function updatedShipmentStatus($statusId)
    // {
    //     $this->selectedShipmentStatus = ShipmentStatus::find($statusId);
    // }

    public function updateCustomerInfo($data)
    {
        $this->customer = $data['customer'];
        $this->rate_to_customer = $data['rate_to_customer'];
        $this->currency = $data['currency'];
        $this->billing_currency_reference = $data['billing_currency_reference'];
        $this->pickup_number = $data['pickup_number'];
        $this->shipment_status = $data['shipment_status'];

        $this->refreshPreview();
    }

    public function handleUpdatePreview($data)
    {
        // if ($data['property'] === 'customer') {
        //     $this->customer = $data['value'];
        // }
    
        // if ($data['property'] === 'shipment_status') {
        //     $this->shipment_status = $data['value'];
        // }

        if ($data['property'] === 'pickup_station') {
            $this->pickup_station = $data['value'];
        }

        if ($data['property'] === 'delivery_date_requested') {
            $this->delivery_date_requested = $data['value'];
        }

        if ($data['property'] === 'requested_pickup_date') {
            $this->requested_pickup_date = $data['value'];
        }

        if ($data['property'] === 'pickup_time') {
            $this->pickup_time = $data['value'];
        }

        if ($data['property'] === 'border_crossing_date') {
            $this->border_crossing_date = $data['value'];
        }

        if ($data['property'] === 'shipperStopOffs') {
            $this->shipperStopOffs = $data['stopOffs']['shipper'] ?? [];
        }

        if ($data['property'] === 'consigneeStopOffs') {
            $this->consigneeStopOffs = $data['stopOffs']['consignee'] ?? [];
        }

        if ($data['property'] === 'delivery_time_requested') {
            $this->delivery_time_requested = $data['value'];
        }

        if ($data['property'] === 'consignee_station') {
            $this->consignee_station = $data['value'];
        }


    }

    public function handleUpdateStopOffs($data)
    {
        $this->shipperStopOffs = $data['shipper'] ?? [];
        $this->consigneeStopOffs = $data['consignee'] ?? [];
    }

    public function render()
    {
        return view('services.service-form', [
            'stations' => $this->stations,
        ]);
    }

    public function refreshPreview()
    {
        // Esto solo asegura que se refresque el componente.
    }

    public function saveService()
    {
        // Verifica que $this->customer no sea null
        if (is_null($this->customer)) {
            // Maneja el error, por ejemplo, lanzando una excepción o retornando un mensaje de error
            throw new \Exception('error', 'Please select a customer.');
        }

        // 1. Registrar cargo
        $cargo = CargoRegistration::createCargo([
            'handling_type' => $this->handling_type,
            'material_type' => $this->material_type,
            'freight_class' => $this->freight_class,
            'count' => $this->count,
            'stackable' => $this->stackable,
            'weight' => $this->weight,
            'uom_weight' => $this->uom_weight,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'uom_dimensions' => $this->uom_dimensions,
            'total_yards' => $this->total_yards,
        ]);

        // 2. Llamar al servicio para registrar el servicio
        $service = ServiceRegistration::createService([
            'user_id' => auth()->id(),
            'customer' => $this->customer,
            'shipment_status' => $this->shipment_status,
            'service_detail_id' => $this->service_detail_id,
            'cargo_id' => $cargo->id, // Asignar el ID del cargo creado
            'rate_to_customer' => $this->rate_to_customer,
            'currency' => $this->currency,
            'billing_currency_reference' => $this->billing_currency_reference,
            'pickup_number' => $this->pickup_number,
            'expedited' => $this->expedited,
            'hazmat' => $this->hazmat,
            'team_driver' => $this->team_driver,
            'round_trip' => $this->round_trip,
            'un_number' => $this->un_number,
        ]);

        // Mensaje de éxito
        session()->flash('message', 'Service registered successfully!');
    }
}
