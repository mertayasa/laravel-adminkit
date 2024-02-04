<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJabatan extends Model
{
    use HasFactory;

    protected $table = 'user_jabatan';

    protected $fillable = [
        'id_jabatan',
        'id_user'  
    ];

    protected $appends = ['nama_jabatan'];

    public function getNamaJabatanAttribute(){
        return $this->jabatan->nama;
    }

    public function jabatan() {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
