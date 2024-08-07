<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = ['Kelas'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'Kelas', 'Kelas');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'Kelas', 'Kelas');
    }
}
