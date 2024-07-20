<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReceiptResource;
use App\Models\Receipt;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ReceiptResource::collection(Receipt::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // to do validation

        DB::beginTransaction();
        try {
            foreach ($request->data as $data) {
                if (isset($data['img']) && $data['img'] instanceof \Illuminate\Http\UploadedFile) {
                    $filename = $data['img']->storeAs(time() . '.' . $data['img']->getClientOriginalExtension(), '', 'public');
                }

                $receipt = Receipt::create([
                    'category' => $data['category'],
                    'date' => $data['date'],
                    'total' => $data['total'],
                    'img' => isset($filename) ? asset('storage/' . $filename) : null
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => new ReceiptResource($receipt),
                'message' => 'Receipt created successfully',
            ], 201);
        } catch (Exception $error) {
            DB::rollBack();
            Log::error($error);

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $receipt = Receipt::findOrFail($id);

            return response()->json([
                'success' => false,
                'data' => new ReceiptResource($receipt),
                'message' => 'Receipt showed successfully',
            ], 200);
        } catch (Exception $error) {
            Log::error($error);

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // to do validation

        DB::beginTransaction();
        try {
            $receipt = Receipt::findOrFail($id);

            // if ($request->has('img'))
            // {
            //     $path = $request->file('img')->store(time() . '.' . $request->file('img')->getClientOriginalExtension(), 'public');
            // }

            $receipt->update([
                'category' => $request->category,
                'date' => $request->date,
                'total' => $request->total,
                'img' => $path ?? null
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'data' => new ReceiptResource($receipt),
                'message' => 'Receipt updated successfully',
            ], 201);
        } catch (Exception $error) {
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Receipt::destroy($id);

        return response()->json([
            'success' => true,
            'data' => '',
            'message' => 'Receipt deleted successfully',
        ], 204);
    }
}
