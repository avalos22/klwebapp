<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\BusinessDirectory;
use App\Models\Contact;

class ContactDetails extends Component
{
    public $directoryId;
    public $directory;
    public $contacts;
    public $showAddContactModal = false;

    // Campos para el formulario del modal
    public $name, $last_name, $office_phone, $cellphone, $email, $working_hours, $notes;

    protected $rules = [
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'office_phone' => 'nullable|string|max:20',
        'cellphone' => 'nullable|string|max:20',
        'working_hours' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
    ];

    public function mount($directoryId)
    {
        $this->directoryId = $directoryId;
        $this->loadData();
    }

    public function loadData()
    {
        $this->directory = BusinessDirectory::findOrFail($this->directoryId);
        $this->contacts = Contact::where('directory_entry_id', $this->directoryId)->get();
    }

    public function showAddContactModal()
    {
        $this->resetForm();
        $this->showAddContactModal = true;
    }

    public function saveContact()
    {
        $this->validate();

        Contact::create([
            'directory_entry_id' => $this->directoryId,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'office_phone' => $this->office_phone,
            'cellphone' => $this->cellphone,
            'email' => $this->email,
            'working_hours' => $this->working_hours,
            'notes' => $this->notes,
        ]);

        $this->showAddContactModal = false;
        $this->loadData();
        session()->flash('success', 'Contact added successfully!');
    }

    private function resetForm()
    {
        $this->reset(['name', 'last_name', 'office_phone', 'cellphone', 'email', 'working_hours', 'notes']);
    }

    public function render()
    {
        return view('business_directory.contacts.contact-details');
    }
}