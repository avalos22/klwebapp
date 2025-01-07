<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\{
    Service,
    BusinessDirectory,
    ShipmentStatus,
    ServiceDetail,
    HandlingType,
    MaterialType,
    FreightClass,
    UrgencyType,
    Uom,
};
use App\Services\{
    ServiceRegistration,
    CargoRegistration,
    ShipperRegistration,
    ConsigneeRegistration,
    UrgencyLtlRegistration,
    StopOffRegistration,
};
use Illuminate\Support\Facades\Log;

class ServiceForm extends Component
{
    public $service_id;

    public $customer;
    public $rate_to_customer;
    public $currency = 'USD';
    public $billing_currency_reference;
    public $pickup_number;
    public $customers;
    public $selectedCustomer;
    public $shipment_status;
    public $selectedShipmentStatus;

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
    
    public $consignee_station;
    public $delivery_date_requested; // Consignees
    public $delivery_time_requested; // Consignees
    public $actual_delivery_date; // Consignees
    public $actual_time; // Consignees
    public $withdrawal_date; // Consignees

    public $pickup_station;
    public $requested_pickup_date; // Shippers
    public $pickup_time; // Shippers
    public $scheduled_border_crossing_date; // Shippers
    public $drop_reception_date; // Shippers

    //urgency_ltl urgency_types
    public $urgency_types;
    public $urgency_type;
    public $emergency_company;
    public $company_id;
    public $phone;

    public $container_modality; // Modalidad: single / full
    public $container_number;
    public $container_size;
    public $container_weight;
    public $container_uom;
    public $container_material_type;

    public $isSaving = false;

    protected $listeners = [
        'updatePreview' => 'handleUpdatePreview',
        'updateCustomerInfo' => 'updateCustomerInfo',
        'updateStopOffs' => 'handleUpdateStopOffs',
    ];

    public function mount()
    {
        $this->loadData();
    }

    private function loadData()
    {
        $this->suppliers = BusinessDirectory::byType('supplier')->get();
        $this->stations = BusinessDirectory::byType('station')->get();
        $this->service_details = ServiceDetail::all();
        $this->handling_types = HandlingType::all();
        $this->materialTypes = MaterialType::all();
        $this->freightClasses = FreightClass::all();
        $this->urgency_types = UrgencyType::all();
        $this->uom_weight_options = Uom::where('description', 'Weight Units')->get();
        $this->uom_dimensions_options = Uom::where('description', 'Units of Length')->get();
    }

    public function updateCustomerInfo($data)
    {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    public function handleUpdatePreview($data)
    {
        if (isset($data['property'], $data['value'])) {
            $this->{$data['property']} = $data['value'];

            if ($data['property'] === 'customer') {
                $this->selectedCustomer = BusinessDirectory::find($data['value']);
            }

            if ($data['property'] === 'shipment_status') {
                $this->selectedShipmentStatus = ShipmentStatus::find($data['value']);
            }
        }
    }

    public function handleUpdateStopOffs($data)
    {
        $this->shipperStopOffs = $data['shipper'] ?? [];
        $this->consigneeStopOffs = $data['consignee'] ?? [];
    }

    public function refreshPreview()
    {
        // Esto solo asegura que se refresque el componente.
    }

    public function saveService()
    {
        if ($this->isSaving) {
            return; 
        }

        $this->isSaving = true;

        try {
            // dd($this->shipperStopOffs);

            $this->validateData(); // Valida los datos antes de proceder

            // Register cargo debe ser el primer registro ya que se necesita el id para el servicio 
            $cargo = CargoRegistration::createCargo($this->getCargoData());
            $urgencyLtl = UrgencyLtlRegistration::createUrgencyLtl($this->getUrgencyLtlData());
            
            if (!$urgencyLtl || !$urgencyLtl->id) {
                throw new \Exception('Failed to create UrgencyLtl or ID is missing.');
            }
            // Register service
            $serviceData = $this->getServiceData($cargo->id);
            $serviceData['urgency_ltl_id'] = $urgencyLtl->id;

            $service = ServiceRegistration::createService($serviceData);
            $this->service_id = $service->id;

            // Register shipper
            $shipper = ShipperRegistration::createShipper($this->getShipperData());
            // Register consignee
            $consignee = ConsigneeRegistration::createConsignee($this->getConsigneeData());
            // Registrar stop-offs
            $this->registerStopOffs();

            session()->flash('message', 'Service registered successfully!');

            // Redirige a la pantalla inicial
            return redirect()->route('dashboard'); // Cambia 'home' por el nombre de tu ruta inicial

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        } finally {
            $this->isSaving = false;
        }
    }

    private function validateData()
    {
        if (is_null($this->customer)) {
            throw new \Exception('Please select a customer.');
        }

        if (empty($this->shipperStopOffs) || empty($this->consigneeStopOffs)) {
            throw new \Exception('Stop-offs for shipper and consignee are required.');
        }
    }

    private function getCargoData()
    {
        return [
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
        ];
    }

    private function getUrgencyLtlData()
    {
        return [
            'type' => $this->urgency_type,
            'emergency_company' => $this->emergency_company,
            'company_ID' => $this->company_id,
            'phone' => $this->phone,
        ];
    }

    private function getServiceData($cargoId)
    {
        return [
            'user_id' => auth()->id(),
            'customer' => $this->customer,
            'shipment_status' => $this->shipment_status,
            'service_detail_id' => $this->service_detail_id,
            'cargo_id' => $cargoId,
            'rate_to_customer' => $this->rate_to_customer,
            'currency' => $this->currency,
            'billing_currency_reference' => $this->billing_currency_reference,
            'pickup_number' => $this->pickup_number,
            'expedited' => $this->expedited,
            'hazmat' => $this->hazmat,
            'team_driver' => $this->team_driver,
            'round_trip' => $this->round_trip,
            'un_number' => $this->un_number,
            'urgency_ltl_id' => $this->urgency_type,
        ];
    }

    private function getShipperData()
    {
        return [
            'service_id' => $this->service_id,
            'requested_pickup_date' => $this->requested_pickup_date,
            'time' => $this->pickup_time ?? '00:00:00',
            'scheduled_border_crossing_date' => $this->scheduled_border_crossing_date,
            'drop_reception_date' => $this->drop_reception_date,
        ];
    }

    private function getConsigneeData()
    { 
        return [
            'service_id' => $this->service_id,
            'delivery_date_requested' => $this->delivery_date_requested,
            'delivery_time_requested' => $this->delivery_time_requested,
            'actual_delivery_date' => $this->actual_delivery_date,
            'actual_time' => $this->actual_time,
            'withdrawal_date' => $this->withdrawal_date,
        ];
    }

    private function registerStopOffs()
    {
        Log::info('Registering stop-offs for shippers and consignees', [
            'pickup_station' => $this->pickup_station,
            'shipperStopOffs' => $this->shipperStopOffs,
            'consignee_station' => $this->consignee_station,
            'consigneeStopOffs' => $this->consigneeStopOffs,
        ]);
    
        // Registrar el pickup_station como la primera posición
        if (!empty($this->pickup_station)) {
            StopOffRegistration::createStopOff([
                'service_id' => $this->service_id,
                'role' => 'shipper',
                'business_directory_id' => $this->pickup_station, // Estación del shipper
                'position' => 0, // Posición en el arreglo
            ]);
    
            Log::info('Pickup station registered successfully', [
                'pickup_station' => $this->pickup_station,
            ]);
        } else {
            Log::error("Missing 'pickup_station'");
            throw new \Exception("Missing 'pickup_station'.");
        }
    
        // Registrar stop-offs para shippers
        foreach ($this->shipperStopOffs as $index => $stopOff) {
            Log::info('Processing shipper stop-off', [
                'index' => $index,
                'stopOff' => $stopOff,
            ]);
    
            if (empty($stopOff['station_id'])) {
                Log::error("Missing 'station_id' in shipper stop-off at position {$index}", [
                    'stopOff' => $stopOff,
                ]);
                throw new \Exception("Missing 'station_id' in shipper stop-off at position {$index}.");
            }
    
            StopOffRegistration::createStopOff([
                'service_id' => $this->service_id,
                'role' => 'shipper',
                'business_directory_id' => $stopOff['station_id'], // Estación del shipper
                'position' => $index + 1, // Posición en el arreglo
            ]);
    
            Log::info('Shipper stop-off registered successfully', [
                'index' => $index,
                'stopOff' => $stopOff,
            ]);
        }
    
        // Registrar el consignee_station como la primera posición
        if (!empty($this->consignee_station)) {
            StopOffRegistration::createStopOff([
                'service_id' => $this->service_id,
                'role' => 'consignee',
                'business_directory_id' => $this->consignee_station, // Estación del consignee
                'position' => 0, // Posición en el arreglo
            ]);
    
            Log::info('Consignee station registered successfully', [
                'consignee_station' => $this->consignee_station,
            ]);
        } else {
            Log::error("Missing 'consignee_station'");
            throw new \Exception("Missing 'consignee_station'.");
        }
    
        // Registrar stop-offs para consignees
        foreach ($this->consigneeStopOffs as $index => $stopOff) {
            Log::info('Processing consignee stop-off', [
                'index' => $index,
                'stopOff' => $stopOff,
            ]);
    
            if (empty($stopOff['station_id'])) {
                Log::error("Missing 'station_id' in consignee stop-off at position {$index}", [
                    'stopOff' => $stopOff,
                ]);
                throw new \Exception("Missing 'station_id' in consignee stop-off at position {$index}.");
            }
    
            StopOffRegistration::createStopOff([
                'service_id' => $this->service_id,
                'role' => 'consignee',
                'business_directory_id' => $stopOff['station_id'], // Estación del consignee
                'position' => $index + 1, // Posición en el arreglo
            ]);
    
            Log::info('Consignee stop-off registered successfully', [
                'index' => $index,
                'stopOff' => $stopOff,
            ]);
        }
    }

    public function render()
    {
        return view('services.service-form', [
            'stations' => $this->stations,
            'customer' => $this->customer,
            'shipment_status' => $this->shipment_status,
            'selectedCustomer' => $this->selectedCustomer,
            'selectedShipmentStatus' => $this->selectedShipmentStatus,
        ]);
    }

}
