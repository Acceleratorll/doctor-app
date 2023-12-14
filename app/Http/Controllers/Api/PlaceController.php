<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    // get my place
    public function myPlace(Request $request)
    {
        try {
            $employee_id = $request->query('employee_id');
            $limit = $request->query('limit') ?? 10;
            $search = $request->query('search');

            if ($search != null) {
                $place = DB::table('places')
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->paginate($limit);
            } else {
                $place = DB::table('places')
                    ->where('employee_id', $employee_id)
                    ->paginate($limit);
            }

            return response()->json([
                'status_code' => 200,
                'message' => 'Data tempat praktek berhasil diambil',
                'meta' => $place,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    // create place
    public function createPlace(Request $request)
    {
        try {
            $employee_id = $request->employee_id;
            $name = $request->name;
            $address = $request->address;
            $reservationable = $request->reservationable ?? 1;

            $place = DB::table('places')->insert([
                'employee_id' => $employee_id,
                'name' => $name,
                'address' => $address,
                'reservationable' => $reservationable,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            return response()->json([
                'status_code' => 201,
                'message' => 'Tempat praktek berhasil ditambahkan',
                'meta' => $place,
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    // update place
    public function updatePlace(Request $request)
    {
        try {
            $id = $request->id;
            $employee_id = $request->employee_id;
            $name = $request->name;
            $address = $request->address;
            $reservationable = $request->reservationable ?? 0;

            $place = DB::table('places')
                ->where('id', $id)
                ->update([
                    'employee_id' => $employee_id,
                    'name' => $name,
                    'address' => $address,
                    'reservationable' => $reservationable,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status_code' => 200,
                'message' => 'Tempat praktek berhasil diupdate',
                'meta' => $place,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    // delete place
    public function deletePlace(Request $request)
    {
        try {
            $id = $request->id;

            $place = DB::table('places')
                ->where('id', $id)
                ->delete();

            return response()->json([
                'status_code' => 200,
                'message' => 'Tempat praktek berhasil dihapus',
                'meta' => $place,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

}
