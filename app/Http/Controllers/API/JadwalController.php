<?php

namespace App\Http\Controllers\API;

use App\Models\Jadwal;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::with('transportasi')->get();;
        return response()->json($jadwal, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'kode' => 'required|unique:jadwals',
                'asal' => 'required',
                'tujuan' => 'required',
                'transportasi_id' => 'required|exists:transportasis,id'
            ]
        );

        $jadwal = Jadwal::create($validate);
        if($jadwal){
            $data['success'] = true;
            $data['message'] = "Data jadwal berhasil disimpan";
            $data['data'] = $jadwal;
            return response()->json($data, 201);
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwal = Jadwal::with('transportasi')->find($id);

        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Data jadwal tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $jadwal
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jadwal = Jadwal::find($id);
         if ($jadwal) {
             $validate = $request->validate(
            [
                'asal' => 'required',
                'tujuan' => 'required',
                'transportasi_id' => 'required|exists:transportasis,id'
                
            ]
            );

        Jadwal::where('id', $id)->update($validate);
       
        if($jadwal){
            $data['success'] = true;
            $data['message'] = "Data Jadwal berhasil diperbarui";
            $data['data'] = $jadwal;
            return response()->json($data, 200);
            };

        }else{
            $data['success'] = false;
            $data['message'] = "Data Jadwal tidak di temukan";
            return response()->json($data, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $transportasi = Transportasi::find($id);

         if($transportasi){
            $transportasi->delete();
            $data['success'] = true;
            $data['message'] = "Data Transportasi berhasil dihapus";
            return response()->json($data, Response::HTTP_OK);
        }else{
            $data['success'] = false;
            $data['message'] = "Data Transportasi tidak di temukan";
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }
}
