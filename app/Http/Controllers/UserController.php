<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\Master\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public string $folder_path = 'user';

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->username !== null && $request->username !== '') {
            $query->where('username', 'like', '%' . $request->username . '%');
        }
        if ($request->status !== null && $request->status !== '') {
            $query->where('is_active', $request->status);
        }
        if ($request->department !== null && $request->department !== '') {
            $query->where('access_group_id', $request->department);
        }
        if ($request->store_id !== null && $request->store_id !== '') {
            $query->where('store_id', $request->store_id);
        }

        $users = $query
            ->orderBy('username')
            ->paginate($this->perPage)
            ->withQueryString();

        return view($this->buildPage('index'), compact('users'));
    }

    public function create()
    {
        return view($this->buildPage('create'));
    }

    public function store(UserRequest $request)
    {
        User::create($request->payload() + [
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('user.index')
            ->with('success', "Berhasil membuat user baru.");
    }

    public function edit(User $user)
    {
        return view($this->buildPage('edit'), compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->payload() + [
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('user.index')
            ->with('success', "Berhasil mengubah data user.");
    }

    public function show(User $user)
    {
        return view($this->buildPage('show'), compact('user'));
    }
}
