<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//Membuat migration untuk tabel 'tabel_buku'
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $table = 'tabel_buku';
    public function up(): void
    {
        //Membuat tabel dengan nama 'tabel_buku'
        Schema::create($this->table,function(Blueprint $struktur){
                $struktur->integer('id_buku',true,true);
                $struktur->string('judul_buku',255)->nullable(false);
                $struktur->string('pengarang',200)->nullable(false);
                $struktur->string('tahun_terbit')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Menghapus tabel jika sudah ada
        Schema::dropIfExists($this->table);
    }
};

/**
 * Migration ini digunakan untuk membuat tabel tabel_buku.
 * Tabel berisi kolom id_buku, judul_buku, pengarang, dan tahun_terbit.
 * Struktur tabel ini akan otomatis dibuat saat perintah migrate dijalankan.
 */