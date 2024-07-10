<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User; // agrega el modelo User

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //return $user;
        $roles = Role::all();
        $user->birthday = optional($user->birthday)->format('Y-m-d');
        $user->date_of_hire = optional($user->date_of_hire)->format('Y-m-d');
        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'job_title' => 'required|string|max:255',
            'office' => 'required|string|max:255',
            'birthday' => 'required|date',
            'date_of_hire' => 'required|date',
            'role' => 'required|exists:roles,id', // Validar que el rol exista
        ]);
    
        // Encontrar el rol por su ID y asegurarse de que exista
        $role = Role::find($validatedData['role']);
    
        // Asignar el rol por su nombre si existe
        if (!$role) {
            // Manejar el caso donde el rol no existe
            return back()->withErrors(['role' => 'El rol seleccionado no existe.']);
        }
    
        // Reemplazar el ID del rol por el nombre del rol en los datos validados
        $validatedData['role'] = $role->name;
    
        // Actualizar datos del usuario
        $user->update($validatedData);
    
        // Desasociar cualquier rol existente
        $user->roles()->detach();
    
        // Asignar el rol al usuario
        $user->assignRole($role->name);
    
        return redirect()->route('users.edit', $user)->with('info', 'Usuario actualizado con éxito.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
