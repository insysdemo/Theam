<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admins.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $html = (string)view('admins.roles.create');
        return response()->json(['html' => $html]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => ['required', 'min:3', 'unique:roles,name']]);
        $roles = new Role();
        $roles->name = $request->name;
        $roles->is_editable   = '1';
        $roles->admin_id = Auth::guard('admin')->user()->id;
        $roles->guard_name = "admin";
        $roles->save();
        return redirect()->route('roles.index');
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
        $role = Role::where('id', $id)->first();
        $html = (string) view('admins.roles.edit', compact('role'));
        return response()->json(['html' => $html]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name' => ['required', 'min:3']]);
        $id = base64_decode($id);

        $role = Role::where('id', $id)->first();
        $role->name = $request->name;
        $role->save();
        return redirect()->route('roles.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Role::where('id', $id)->delete();
        return response()->json(['message' => "success"]);

    }

    public function list(Request $request)
    {

        $jsonArray = array();
        $jsonArray['draw'] = intval($request->input('draw'));

        $columns = array(
            0 => 'id',
            1 => 'name',
        );
        $column = $columns[$request->order[0]['column']];
        $dir = $request->order[0]['dir'];
        $offset = $request->start;
        $limit = $request->length;

        $roles = new Role();
        $roles = $roles->where('admin_id', Auth::guard('admin')->user()->id);
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
            $delete = '';
            $edit = '';
            if (Auth::guard('admin')->user()->can('Role delete')) {
                if ($row->is_editable == 1) {
                    // $delete = (string) view("admins.common.deletebtn", ["url" => route('roles.destroy', base64_encode($row->id))]);
                    $delete = '<button class="btn btn-danger shadow btn-sm sharp " onclick="deleteModal(' . $row->id . ')" style="width: 40px;">
    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" style="fill: white;"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
</button>';
                }
            }
            if (Auth::guard('admin')->user()->can('Role edit')) {
                $edit = '<a onclick="editRole(' . $row->id . ')" data-target="commonModal" class="mr-1 shadow btn btn-primary btn-sm sharp" style="width:40px;" >' . '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"style="fill:white; " ><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/></svg>' . '</a>';
            }
            $jsonObject = array();
            if ($row->is_editable == 1) {
                $jsonObject[] = '<input type="checkbox" class="w-4 h-4 check-item" name="checkid[]" value="' . $row->id . '"/>';
            } else {
                $jsonObject[] = ' - ';
            }
            $jsonObject[] = $row->name;
            $jsonObject[] = $delete . $edit;
            $jsonArray['data'][] = $jsonObject;
        }
        echo json_encode($jsonArray);
    }
}
