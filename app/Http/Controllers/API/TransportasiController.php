<?php

namespace App\Http\Controllers\API;

use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class TransportasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transportasi = Transportasi::all();
        return response()->json($transportasi, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'kode' => 'required|unique:transportasis',
                'nama' => 'required',
                'jenis' => 'required',
                'kapasitas' => 'required|numeric'
            ]
        );

        $transportasi = Transportasi::create($validate);
        if($transportasi){
            $data['success'] = true;
            $data['message'] = "Data Transportasi berhasil disimpan";
            $data['data'] = $transportasi;
            return response()->json($data, 201);
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transportasi = Transportasi::all();

        if ($transportasi->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada fakultas yang ditemukan.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'Fakultas ditemukan.',
            'data' => $transportasi
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transportasi = Transportasi::find($id);
         if ($transportasi) {
             $validate = $request->validate(
            [
                'nama' => 'required',
                'jenis' => 'required',
                'kapasitas' => 'required|numeric'
                
            ]
            );

        Transportasi::where('id', $id)->update($validate);
       
        if($transportasi){
            $data['success'] = true;
            $data['message'] = "Data Transportasi berhasil diperbarui";
            $data['data'] = $transportasi;
            return response()->json($data, 200);
            };

        }else{
            $data['success'] = false;
            $data['message'] = "Data Transportasi tidak di temukan";
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
