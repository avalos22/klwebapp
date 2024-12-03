<?php

namespace App\Http\Controllers;
use App\Models\BusinessDirectory;
use App\Models\FactoryCompany;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BusinessDirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = BusinessDirectory::all();
        return view('business_directory.index', compact('entries'));
    }

    public function createDirectory(Request $request)
    {
        $type = $request->get('type'); // Captura el tipo de registro
        $factoryCompanies = FactoryCompany::all(); // Datos necesarios para el formulario

        return view('business_directory.create', compact('type', 'factoryCompanies'));
    }

    private function storeDocument($request, $key, $directory = null)
    {
        if ($request->hasFile($key)) {
            if ($directory && $directory->$key) {
                Storage::disk('public')->delete($directory->$key);
            }
            $documentPath = $request->file($key)->store('documents', 'public');
            logger('Document stored at:', ['path' => $documentPath]);
            return $documentPath;
        }
        return $directory ? $directory->$key : null;
    }

    private function validationRules()
    {
        return [
            'type' => 'required|in:station,customer,supplier',
            'company' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'billing_currency' => 'required|in:USD,MXN',
            'rfc_tax_id' => 'nullable|string|max:20',
            'street_address' => 'nullable|string|max:255',
            'building_number' => 'nullable|string|max:20',
            'neighborhood' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'credit_days' => 'nullable|integer',
            'credit_expiration_date' => 'nullable|date',
            'free_loading_unloading_hours' => 'nullable|integer',
            'factory_company_id' => 'nullable|exists:factory_companies,id',
            'notes' => 'nullable|string',
            'document_expiration_date' => 'nullable|date',
            'picture' => 'nullable|image|max:2048',
            'add_document' => 'nullable|file|max:2048',
            'tarifario' => 'nullable|file|max:2048',
        ];
    }

    public function storeDirectory(Request $request)
    {
        // Validación de datos
        $validated = $request->validate($this->validationRules());

        $picturePath = $this->storeDocument($request, 'picture');
        $documentPath = $this->storeDocument($request, 'add_document');
        $tarifarioPath = $this->storeDocument($request, 'tarifario');

        // Crear nueva entrada
        BusinessDirectory::create(array_merge($validated, ['picture' => $picturePath, 'add_document' => $documentPath,'tarifario' => $tarifarioPath]));

        // Redirigir con éxito
        return redirect()->route('business-directory.index')->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $directory = BusinessDirectory::findOrFail($id);
        $factoryCompanies = FactoryCompany::all();
        return view('business_directory.edit', compact('directory', 'factoryCompanies'));
    }

    public function update(Request $request, $id)
    {
        $directory = BusinessDirectory::findOrFail($id);

        // Validación
        $validated = $request->validate($this->validationRules());

        $picturePath = $this->storeDocument($request, 'picture', $directory);
        $documentPath = $this->storeDocument($request, 'add_document', $directory);
        $tarifarioPath = $this->storeDocument($request, 'tarifario');

        // Actualizar entrada existente
        $directory->update(array_merge($validated, ['picture' => $picturePath, 'add_document' => $documentPath, 'tarifario' => $tarifarioPath]));

        return redirect()->route('business-directory.index')->with('success', 'Directory updated successfully!');
    }

    public function showContacts($id)
    {
        $directory = BusinessDirectory::with(['contacts'])->findOrFail($id);
        $contacts = $directory->contacts()->paginate(10);
        return view('business_directory.contacts.index', compact('directory', 'contacts'));
    }

    public function ContactDetails($id)
    {
        $directory = BusinessDirectory::findOrFail($id);
        return view('business_directory.contacts.contact-details', compact('directory'));
    }

    public function storeContact(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'office_phone' => 'nullable|string|max:20',
            'cellphone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'working_hours' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $contact = new Contact($validated);
        $contact->directory_entry_id = $id;
        $contact->save();

        return redirect()->route('business-directory.index')->with('success', 'Contact added successfully.');
    }
}