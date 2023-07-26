<?php

namespace App\Http\Controllers\Clinc;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Http\Traits\GeneralTrait;
use App\Models\Clinc;
use App\Models\Doctor;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class ClincController extends Controller
{
    use GeneralTrait;
    //
    public function getClinc()
    {

        {
            try {
                $clinc = Clinc::with('image')->get();
                $msg = 'Done';

                return $this->successResponse($clinc, $msg);
            } catch (\Exception $e) {
                return $this->errorResponse($e->getMessage(), 500);
            }
        }
    }


    public function getDoctorClinc(Clinc $clinc)
    {
        try {
            // $clinc=Clinc::find($clinc)->get();
            $doctors = $clinc->doctors()->get();

            return $this->successResponse(DoctorResource::collection($doctors), 'Doctors of the clinic retrieved successfully');
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Clinc $clinc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinc $clinc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinc $clinc)
    {
        //
    }
}
