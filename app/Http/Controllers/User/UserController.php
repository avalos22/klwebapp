<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User; // agrega el modelo User

use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Obtener todos los usuarios
        $roles = Role::all();  // Obtener todos los roles disponibles
        return view('users.index', compact('users', 'roles')); // Pasar usuarios a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all(); // Obtener todos los roles disponibles
        return view('users.create', compact('roles')); // Pasar roles a la vista
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20',
            'job_title' => 'required|string|max:255',
            'office' => 'required|string|max:255',
            'role' => 'required|exists:roles,id',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validación de la imagen
        ]);

         // Si se ha subido una imagen, guardarla en el directorio profile-photos
         if ($request->hasFile('picture')) {
            // Mover el archivo a la carpeta 'public/storage/profile-photos'
            $picturePath = $request->file('picture')->store('profile-photos', 'public');
            
            // Actualizar el campo 'profile_photo_path' del usuario con la ruta
            // $user->update(['profile_photo_path' => $picturePath]);
        }

        // Crear usuario
        $user = User::create([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'phone' => $validatedData['phone'],
            'job_title' => $validatedData['job_title'],
            'office' => $validatedData['office'],
            'profile_photo_path' => $picturePath ?? null,  // Guardar el *path* de la imagen si existe
        ]);

        // Asignar el rol al usuario
        $role = Role::findOrFail($validatedData['role']);
        $user->assignRole($role->name);
  
        // Registrar la actividad
        // activity()
        // ->causedBy(auth()->user()) // Quién causó la acción
        // ->performedOn($user) // En qué entidad se realizó la acción
        // ->withProperties(['attributes' => $validatedData]) // Opcional: Detalles adicionales
        // ->log('user created'); // Mensaje personalizado

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
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
        //$user->birthday = optional($user->birthday)->format('Y-m-d');
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
            'role' => 'required|exists:roles,id', // Validar que el rol exista
            'password' => 'nullable|string|min:8|confirmed', // Nueva validación para la contraseña
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validación para la imagen
        ]);
        
        // Actualizar foto de perfil si se sube una nueva
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('profile-photos', 'public');
            // Log::info('Profile photo path:', ['path' => $picturePath]); // Registra la ruta para verificar
            // dd($picturePath);
            $validatedData['profile_photo_path'] = $picturePath;
            
        }

        // Actualizar contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->input('password'));
        } else {
            unset($validatedData['password']); // Elimina la clave si no se está actualizando la contraseña
        }
    
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

        // Guarda manualmente el campo de la imagen si no se guarda con el `update()`
        if (isset($validatedData['profile_photo_path'])) {
            $user->profile_photo_path = $validatedData['profile_photo_path'];
            $user->save();
        }
    
        // Desasociar cualquier rol existente
        $user->roles()->detach();
    
        // Asignar el rol al usuario
        $user->assignRole($role->name);

        // Registrar la actividad
        // activity()
        // ->causedBy(auth()->user()) // Quién causó la acción
        // ->performedOn($user) // En qué entidad se realizó la acción
        // ->withProperties(['attributes' => $validatedData]) // Opcional: Detalles adicionales
        // ->log('Usuario actualizado'); // Mensaje personalizado
    
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
