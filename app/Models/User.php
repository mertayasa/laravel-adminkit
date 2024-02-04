<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'status',
        'username',
        'password',
        'tanggal_bergabung',
        'id_unit',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static $admin = 'admin';
    static $karyawan = 'karyawan';
    static $active = 'active';
    static $nonactive = 'nonactive';

    public function loginlog() {
        return $this->hasMany(LoginLog::class, 'id_user');
    }

    public function userjabatan() {
        return $this->hasMany(UserJabatan::class, 'id_user');
    }

    public function unit() {
        return $this->belongsTo(Unit::class, 'id_unit');
    }

    // public function getImage()
    // {
    //     $image_path = $this->attributes['foto'];
    //     $isExists = File::exists(public_path($image_path));
    //     if ($isExists and $this->attributes['foto'] != '') {
    //         return asset($image_path);
    //     } else {
    //         return asset('default/avatar.png');
    //     }
    // }
}
