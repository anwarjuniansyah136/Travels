<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Types\Relations\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $query = Roles::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        $data = $query->orderByDesc('id')->paginate(10);
        return view('Admin.roles', compact('data'));
    }

    /**
     * Search roles
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function create()
    {
        return view('admin.create_role');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $role = new Roles();
        $role->name = $name;
        $role->status = 'active';
        $role->save();

        return redirect('/roles')->with('success', 'Role berhasil ditambahkan');
    }

    public function edit($id)
    {
        $role = roles::findOrFail($id);
        return view('roles.edit', compact('role'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,non active',
        ]);

        $role = roles::findOrFail($id);
        $role->name = $request->name;
        $role->status = $request->status;
        $role->save();

        return redirect('/roles')->with('success', 'Role berhasil diupdate');
    }

    public function destroy($id)
    {
        $role = roles::findOrFail($id);
        $role->status = $role->status === 'active' ? 'non active' : 'active';
        $role->save();

        return back()->with('success', 'Status role berhasil diubah');
    }

    public function forceDestroy($id)
    {
        $role = roles::findOrFail($id);
        $role->delete();
        return back()->with('success', 'Role berhasil dihapus permanen');
    }
}
