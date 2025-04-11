<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $id_buku,$judul_buku,$pengarang,$tahun_terbit,$buku;
    public function index(Request $request)
    {
        $this->buku = BukuModel::all();
        return response()->json(
            [
                'buku' => $this->buku
            ],200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { //menyimpan data buku baru.
        
        //Validasi manual (bisa diganti dengan $request->validate()).
        if(empty($request->judul_buku) || empty($request->tahun_terbit)):
            $pesan = [
                [
                    'status' => false,
                    'message' => 'Data tidak boleh kosong'
                ],    
            ];
            $status = 403;

        else: //Jika lolos validasi, data disimpan ke database.
            $data =[
                'judul_buku'   => $request->judul_buku,
                'pengarang'    => $request->pengarang,
                'tahun_terbit' => $request->tahun_terbit,
            ];
            BukuModel::create($data);
            $pesan = [
                [
                    'status' =>   true,
                    'message' => 'Data berhasil ditambahkan'
                ]
            ];
            $status = 200;
            endif;

            //Mengembalikan response berdasarkan hasil validasi/simpan.
            return response()
                    ->json($pesan, $status);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    { //Mengambil data buku berdasarkan id_buku.
      
        $data = BukuModel::where('id_buku','=',$id)->get();
        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {//Melakukan validasi manual apakah semua field terisi.
        
        if (empty($request->judul_buku)|| empty($request->pengarang)|| empty($request->tahun_terbit)):
            $pesan = [
                'status' => false,
                'message' => 'Update data gagal, periksa lagi data yang dikirim'
            ];
            $status = 403;

        else:
            $data = [
                'judul_buku' => $request->judul_buku,
                'pengarang' => $request->pengarang,
                'tahun_terbit' => $request->tahun_terbit,
            ];
            $update = BukuModel::where('id_buku','=',$id)->update($data);
            if($update):
                $pesan = [
                    'status'  => true,
                    'message' =>'Data berhasil diperbarui'
                ];
                $status = 201;
            else:
                $pesan  = [
                    'status'  => false,
                    'message' => 'Data gagal diperbarui'
                ];
                $status = 400; //Forbidden
            endif;
        endif;
        return response()->json($pesan,$status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {//Mencari data buku berdasarkan ID lalu menghapusnya.
    
        $aksiHapus = BukuModel::where('id_buku','=',$id)->delete();
        if($aksiHapus):
            $pesan = [
                [
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ],    
            ];
            $status = 200;
        else:
            $pesan = [
                [
                    'status' => false,
                    'message' => 'Data gagal dihapus'
                ],    
            ];
            $status = 401;
        endif;
        return response()->json($pesan,$status);
    }
}
