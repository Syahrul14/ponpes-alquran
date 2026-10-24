<?php

namespace App\Repositories\Administrator\Management;

use App\Models\User;

class AdminManagementRepository
{
    public function getAllUsers()
    {
        return User::orderBy('id', 'asc')->get();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function store(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }

    public function count()
    {
        return User::count();
    }
}

