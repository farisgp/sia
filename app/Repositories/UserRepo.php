<?php

namespace App\Repositories;

use App\Models\BloodGroup;
use App\Models\StaffRecord;
use App\Models\UserType;
use App\Models\KelolaUser;
use App\User;


class UserRepo {


    public function update($id, $data)
    {
        return KelolaUser::find($id)->update($data);
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function create($data)
    {
        return User::create($data);
    }
    public function find($id)
    {
        return User::find($id);
    }
}