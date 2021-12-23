<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

function formatPrice($value)
{
    return 'Rp ' . number_format($value, 0, ',', '.');
}

function isActive($param)
{
    if (is_array($param)) {
        foreach ($param as $par) {
            if (Request::route()->getPrefix() == '/' . $par) {
                return 'active';
            }
        }
    } else {
        return Request::route()->getPrefix() == '/' . $param ? 'active' : '';
    }

    return '';
}

function showFor($roles)
{
    foreach ($roles as $role) {
        if (roleName() == $role) {
            return true;
        }
    }

    return false;
}

function roleName($level = null)
{
    return true;
    // $role_name = ($level ?? Auth::user()->level) == User::$admin ? 'admin' : (($level ?? Auth::user()->level) == User::$role2 ? 'role2' : User::$role3);

    // return $role_name;
}

function authUser()
{
    return Auth::user();
}

function indonesianDate($date)
{
    return Carbon::parse($date)->isoFormat('LL');
}

function getAge($date)
{
    $birth_date = Carbon::parse($date);
    $now = Carbon::now();

    return $birth_date->diffInYears($now);
}

function getGender($gender)
{
    return $gender == 'laki' ? 'Laki-Laki' : 'Perempuan';
}

function getStatus($status)
{
    return $status == 1 ? '<span class="badge badge-primary">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>';
}

function uploadFile($base_64_foto, $folder)
{
    try {
        $foto = base64_decode($base_64_foto['data']);
        $folderName = 'images/' . $folder;

        if (!file_exists($folderName)) {
            mkdir($folderName, 0755, true);
        }

        // return $folderName;

        $safeName = time() . $base_64_foto['name'];
        $inventoriePath = public_path() . '/' . $folderName;
        file_put_contents($inventoriePath . '/' . $safeName, $foto);
        // return 'fcuk';
    } catch (Exception $e) {
        Log::info($e->getMessage());
        return 0;
    }

    return $folder . '/' . $safeName;
}

function strConInArray($array, $check)
{
    foreach($array as $arr){
        if(stripos($check, $arr) !== false){
            return false;
        }
    }
    return true;
}