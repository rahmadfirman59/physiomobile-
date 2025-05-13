<?php

namespace App\Services;

use App\Models\User;

class UserServices
{

    public function all()
    {
        return User::with(['patient'])->get();
    }

    public function one($id)
    {
        return User::with(['patient'])->where("id",$id)->first();
    }

    public function create($data)
    {
        return User::create($data);
    }

    public function update($data,$id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update($data);
        }
        return $user;
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

}
