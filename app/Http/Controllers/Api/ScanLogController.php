<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreScanLogRequest;
use App\Http\Requests\UpdateScanLogRequest;
use App\Models\ScanLog;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScanLogResource;
use App\Models\RegisteredUser;
use Carbon\Carbon;
use App\Http\Resources\RegisteredUserResource;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

class ScanLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ScanLogResource::collection(ScanLog::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScanLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ScanLog $scan_log)
    {

        return new ScanLogResource($scan_log);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScanLog $scanLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScanLogRequest $request, ScanLog $scanLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScanLog $scanLog)
    {
        //
    }

    public function UpdateOrCreateScanLog(string $registration_id)
    {
        try {
            $scanLog = ScanLog::where('registration_id', $registration_id)->first();
            if ($scanLog && !$scanLog->is_scanned) {
                return $scanLog->update(
                    [
                        'is_scanned' => true,
                        'scan_time' => Carbon::now('Asia/Riyadh'),
                    ]
                );

            } else {
                return ScanLog::Create(
                    [
                        'registration_id' => $registration_id,
                        'is_scanned' => true,
                        'scan_time' => Carbon::now('Asia/Riyadh'),
                    ]
                );



            }
            //  return  ScanLog::updateOrCreate(
            //     ['registration_id' => $registration_id],
            //     [
            //         'is_scanned' => true,
            //         'scan_time' => Carbon::now('Asia/Riyadh'),
            //     ]
            //    );
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 401);


        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }


    }
    public function scanRegisteredUser(string $registration_id)
    {

        try {
            $registeredUser = RegisteredUser::where('registration_id', $registration_id)->first();

            if ($registeredUser) {
                $this->UpdateOrCreateScanLog($registeredUser->registration_id);

                return response()->json(
                    new RegisteredUserResource($registeredUser)
                );

            } else {
                return response()->json(['message' => 'User not found'], 401);
            }
        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => 'url not found', 'message' => $e->getMessage()], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }

    }



    public function getUpdatedScanLog()
    {

        try {
            $today = Carbon::today('Asia/Riyadh');
            $log = ScanLog::with('user')->whereDate('scan_time', $today)->get();
            

            $logs = ScanLogResource::collection($log);
            return response()->json($logs);

        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => 'url not found', 'message' => $e->getMessage()], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error', 'message' => $e->getMessage()], 500);
        }

    }



    public function getScanLogByDate(Request $request)
    {

        $dateTime = $request->input('date');
        if ($dateTime) {
            return ScanLogResource::collection(ScanLog::whereDate('scan_time', $dateTime)->get());
        }
        return ScanLogResource::collection(ScanLog::all());
    }


}


