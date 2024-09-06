<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Models\RoleHasPermission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admins.role_has_permission.index');
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
    public function edit(string $id)
    {
        $data = RoleHasPermission::select('permission_id')->where('role_id', $id)->get();
        $Permission = Permission::orderBy('name')->get()->groupBy('role_name');
        $role = Role::where('id', $id)->first();
        $arrayid = [];
        foreach ($data as $permission_id) {
            $arrayid[] = $permission_id->permission_id;
        }
        $html = (string)view('admins.role_has_permission.edit', compact(['arrayid', 'Permission', 'id']));
        return response()->json(['html' => $html, 'role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = base64_decode($id);

        $Role = Role::with('permissions')->findOrFail($id);
        $permissions = $request->permisssion; 

        $permissionNames = Permission::whereIn('id', $permissions)->pluck('name')->toArray();
    
        $Role->syncPermissions($permissionNames);
        $Role->load('permissions');


    
        // $Role->revokePermissionTo(Permission::all());
        
        // if (isset($request->permisssion)) {
        //     foreach ($request->permisssion as $give_permission) {
        //         $Role = Role::where('id', $id)->first();
        //         $per = Permission::where('id', $give_permission)->first();
        //     }
        // }
        return redirect()->back()->with('success', 'Access updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function list(Request $request)
    {
        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));

        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'updated_at'
        );
        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;

        $roles = Role::query();
        $roles = $roles->where('id', '!=', 1);
        $jsonArray['recordsTotal'] = $roles->count();
        if ($request->search['value']) {
            $search = $request->search['value'];
            $roles = $roles->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', "%{$search}%");
            });
        }
        $jsonArray['recordsFiltered'] = $roles->count();
        $roles = $roles->orderby($column, $dir)->offset($offset)->limit($limit)->get();
        $jsonArray['data'] = array();
        foreach ($roles as $row) {
            $Role_has_permission = RoleHasPermission::where('role_id', $row->id)->get();
            $array = [];

            foreach ($Role_has_permission as $permission) {
                $permission_name = Permission::where('id', $permission->permission_id)->first();

                if (optional($permission_name)->name) {
                    $array[] = '<span class="spanText bg-primary">' . $permission_name->name . '</span>';
                }
            }


            $final_str = implode(",", $array);
            $edit = '';
            if (Auth::guard('admin')->user()->can('Rolehaspermission edit')) {
                $edit = '<a onclick="editRoleHasPermission(' . $row->id . ')" data-target="commonModal" class="mr-1 shadow btn btn-primary btn-sm sharp" style="width:40px;" >' . '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"style="fill:white; " ><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/></svg>' . '</a>';
            }
            $jsonObject = array();
            $jsonObject[] = '<input type="checkbox" class="w-4 h-4 check-item" name="checkid[]" value="' . $row->id . '"/>';
            $jsonObject[] = $row->name;
            $jsonObject[] =   '<div class="datatableFlex">' . $final_str . '</div>';
            $jsonObject[] = ($row->updated_at->format('Y-m-d H:i:s'));
            $jsonObject[] =  $edit;
            $jsonArray['data'][] = $jsonObject;
        }
        echo json_encode($jsonArray);
    }
}
