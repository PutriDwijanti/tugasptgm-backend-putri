<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuModel extends Model
{
    use HasFactory; //Mengaktifkan fitur factory pada model ini
    protected $table = 'tabel_buku'; // Menentukan nama tabel yang digunakan oleh model
    protected $primaryKey = 'id_buku'; //Menentukan primary key dari tabel
    protected $fillable = [ //Kolom-kolom yang boleh diisi secara massal
                             'judul_buku',
                             'pengarang',
                             'tahun_terbit'
                        ];
    public $timestamps = false; //Menonaktifkan fitur created_at dan updated_at

}
