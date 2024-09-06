<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{


    public function __construct()
    {
        // Specific permission for the create action
        $this->middleware('can:Users create,Spatie\Permission\Models\Permission')->only('create');

        // Specific permission for the create action
        $this->middleware('can:Users edit,Spatie\Permission\Models\Permission')->only('edit');

        // Specific permission for the destroy action
        $this->middleware('can:Users delete,Spatie\Permission\Models\Permission')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admins.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::get();
        return view('admins.users.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->role);
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
                'role' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'name.required' => 'Please enter your name.',
                'email.required' => 'Email is required.',
                'email.email' => 'Please provide a valid email address.',
                'email.unique' => 'This email is already taken.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters long.',
                'password.confirmed' => 'Passwords do not match.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
                'image.max' => 'The image may not be greater than 2MB.',
            ]
        );

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageData = file_get_contents($image);
            $validatedData['image'] = $imageData;
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'image' => $validatedData['image'], 
        ]);
        $admin = Admin::create([
            'user_id' => $user->id,
            'admin_id' => Auth::guard('admin')->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
        ]);

        $roleName = Role::findOrFail($request->role)->name;

        $admin->assignRole($roleName);


        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
    public function edit(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
        $userImage = $user->image ? 'data:image/jpeg;base64,' . base64_encode($user->image) : null;

        $role = Role::get();
        return view('admins.users.edit', compact('user', 'role', 'userImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already taken.',
            'password.min' => 'Password must be at least 6 characters long.',
            'password.confirmed' => 'Passwords do not match.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageData = file_get_contents($image);
            $validatedData['image'] = $imageData;

        }

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);
        $admin = Admin::where('user_id', $id)->first();
        $admin->admin_id = Auth::guard('admin')->user()->id;
        $admin->name = $request->name;
        $admin->email = $request->email;
        if (isset($request->password)) {
            $admin->password = Hash::make($request->password);
        }
        $admin->role_id = $request->role;
        $admin->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();

        return response()->json(['message' => "success"]);
    }


    public function list(Request $request)
    {

        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));

        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
        );
        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;

        $user = new User();
        // $user = $user->where('admin_id', Auth::guard('admin')->user()->id);
        $jsonArray['recordsTotal'] = $user->count();
        if ($request->search['value']) {
            $search = $request->search['value'];
            $user = $user->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%{$search}%");
                $query->orWhere('email', 'like', "%{$search}%");
            });
        }
        $jsonArray['recordsFiltered'] = $user->count();
        $user = $user->orderby($column, $dir)->offset($offset)->limit($limit)->get();
        $jsonArray['data'] = array();
        foreach ($user as $row) {
            $delete = '';
            $edit = '';
            if (Auth::guard('admin')->user()->can('Users delete')) {
                $delete = '<button class="btn btn-danger shadow btn-sm sharp " onclick="deleteModal(' . $row->id . ')" style="width: 40px;">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" style="fill: white;"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
            </button>';
            }
            if (Auth::guard('admin')->user()->can('Users edit')) {
                $edit = '<a href="' . route('users.edit', $row->id) . '" class="mr-1 shadow btn btn-primary btn-sm sharp" style="width:40px;">' .
                    '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" style="fill:white;">' .
                    '<path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/>' .
                    '</svg>' .
                    '</a>';
            }

            $jsonObject = array();
            if ($row->is_editable == 1) {
                $jsonObject[] = '<input type="checkbox" class="w-4 h-4 check-item" name="checkid[]" value="' . $row->id . '"/>';
            } else {
                $jsonObject[] = ' - ';
            }
            $jsonObject[] = $row->name;
            $jsonObject[] = $row->name;
            $jsonObject[] = $row->email;
            $jsonObject[] = $delete . $edit;
            $jsonArray['data'][] = $jsonObject;
        }
        echo json_encode($jsonArray);
    }
}
