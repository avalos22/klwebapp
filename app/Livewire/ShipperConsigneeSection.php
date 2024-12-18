<?php

namespace App\Livewire;

use Livewire\Component;

class ShipperConsigneeSection extends Component
{
    public $stations;
    public $shipperStopOffs = [];
    public $consigneeStopOffs = [];
    public $pickup_station;
    public $delivery_date_requested;
    public $delivery_time_requested;
    public $consignee_station;
    public $requested_pickup_date;
    public $pickup_time;
    public $border_crossing_date;

    public function mount($stations)
    {
        $this->stations = $stations;

        // Inicializar estructuras de datos
        $this->shipperStopOffs = [['station_id' => null]];
        $this->consigneeStopOffs = [['station_id' => null]];
    }

    public function updated($propertyName)
    {
        $propertyValue = $this->getPropertyValue($propertyName);

        $this->dispatch('updatePreview', [
            'property' => $propertyName,
            'value' => $propertyValue,
        ]);
    }

    public function addStopOff($type)
    {
        if ($type === 'shipper') {
            $this->shipperStopOffs[] = $stopOff;
        } elseif ($type === 'consignee') {
            $this->consigneeStopOffs[] = $stopOff;
        }

        $this->dispatch('updateStopOffs', [
            'shipper' => $this->shipperStopOffs,
            'consignee' => $this->consigneeStopOffs,
        ]);
    }

    public function removeStopOff($type, $index)
    {
        if ($type === 'shipper') {
            unset($this->shipperStopOffs[$index]);
            $this->shipperStopOffs = array_values($this->shipperStopOffs);
        } elseif ($type === 'consignee') {
            unset($this->consigneeStopOffs[$index]);
            $this->consigneeStopOffs = array_values($this->consigneeStopOffs);
        }

        $this->dispatch('updateStopOffs', [
            'shipper' => $this->shipperStopOffs,
            'consignee' => $this->consigneeStopOffs,
        ]);
    }

    public function updateStopOffStation($type, $index, $value)
    {
        if ($type === 'shipper') {
            $this->shipperStopOffs[$index]['station_id'] = $value;
        } elseif ($type === 'consignee') {
            $this->consigneeStopOffs[$index]['station_id'] = $value;
        }

        $this->dispatch('updateStopOffs', [
            'shipper' => $this->shipperStopOffs,
            'consignee' => $this->consigneeStopOffs,
        ]);
    }

    public function updatePreview($propertyName, $value)
    {
        $this->$propertyName = $value;

        $this->dispatch('updatePreview', [
            'property' => $propertyName,
            'value' => $value,
        ]);
    }

    public function render()
    {
        return view('services.shipper-consignee-section');
    }

    public function refreshPreview()
    {
        // Esto solo asegura que se refresque el componente.
    }
}
