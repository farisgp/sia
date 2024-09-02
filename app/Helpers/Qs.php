<?php

namespace App\Helpers;

use App\Models\Setting;
use App\Models\Siswa;
use App\Models\Guru;
use Hashids\Hashids;


class Qs {
    public static function getSetting($type)
    {
        return Setting::where('type', $type)->first()->deskripsi;
    }
    // public static function jsonUpdateOk()
    // {
    //     return self::json(__('msg.update_ok'));
    // }
    public static function hash($id)
    {
        $date = date('dMY').'CJ';
        $hash = new Hashids($date, 14);
        return $hash->encode($id);
    }
    public static function findStudentRecord($user_id)
    {
        return Siswa::where('user_id', $user_id)->first();
    }
    public static function findGuruRecord($user_id)
    {
        return Guru::where('user_id', $user_id)->first();
    }
}
?>