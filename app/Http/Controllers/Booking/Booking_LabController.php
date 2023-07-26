<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Http\Resources\Booking_LabResource;
use App\Http\traits\GeneralTrait;
use App\Models\Booking_Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Booking_LabController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    try {
        $userId = Auth::id();
        $bookings = Booking_Lab::where('user_id', $userId)->get();
        $bookingResource = Booking_LabResource::collection($bookings);

        $message = 'Success: Clinic bookings retrieved successfully';
        return $this->successResponse($bookingResource, $message);
    } catch (\Exception $ex) {
        return $this->errorResponse($ex->getMessage(), 500);
    }
}
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request['user_id'] = Auth::id();

        $rules = [
            'booking_lab_name' => 'required',
            'booking_lab_father_name' => 'required',
            'booking_lab_age' => 'required',
            'booking_lab_gender' => 'required|in:0,1',
            'name_analysis' => 'required',
            'lab_id' => 'required|exists:labs,id',
            'doctor_lab_id' => 'required|exists:doctor_labs,id',
            'user_id' => 'required|exists:users,id',
            'booking_date' => 'date',
            'booking_datetime' => 'date_format:Y-m-d H:i:s',
        ];

        $messages = [
            'booking_lab_name.required' => 'The booking lab name field is required.',
            'booking_lab_father_name.required' => 'The booking lab father name field is required.',
            'booking_lab_age.required' => 'The booking lab age field is required.',
            'booking_lab_gender.required' => 'The booking lab gender field is required.',
            'booking_lab_gender.in' => 'Invalid booking lab gender. Valid values are: 0, 1.',
            'name_analysis.required' => 'The name analysis field is required.',
            'lab_id.required' => 'The lab ID field is required.',
            'lab_id.exists' => 'Invalid lab ID.',
            'doctor_lab_id.required' => 'The doctor lab ID field is required.',
            'doctor_lab_id.exists' => 'Invalid doctor lab ID.',
            'user_id.required' => 'The user ID field is required.',
            'user_id.exists' => 'Invalid user ID.',
            'booking_date.date' => 'Invalid booking date format.',
            'booking_datetime.date_format' => 'Invalid booking date and time format. It should be in Y-m-d H:i:s format.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        try {
            $booking = new Booking_Lab();
            $booking->booking_lab_name = $request->input('booking_lab_name');
            $booking->booking_lab_father_name = $request->input('booking_lab_father_name');
            $booking->booking_lab_age = $request->input('booking_lab_age');
            $booking->booking_lab_gender = $request->input('booking_lab_gender');
            $booking->name_analysis = $request->input('name_analysis');
            $booking->lab()->associate($request->input('lab_id'));
            $booking->doctor_lab()->associate($request->input('doctor_lab_id'));
            $booking->user()->associate($request->input('user_id'));
            $booking->booking_date = $request->input('booking_date');
            $booking->booking_datetime = $request->input('booking_datetime');
            $booking->save();

            $msg = 'Lab booking created successfully';
            $bookingResource = new Booking_LabResource($booking);

            return $this->successResponse($bookingResource->toArray($request), $msg);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Booking_Lab $booking_Lab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking_Lab $booking_Lab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking_Lab $booking_Lab)
    {
        {
            //
            try {
                // Check if the authenticated user has the necessary permissions to delete the booking, if needed.
                // Replace 'your_user_permission_check_here' with your actual permission check logic.
                // For example, you may check if the user is the owner of the booking.

                // your_user_permission_check_here($booking);

                $booking_Lab->delete();
                return $this->successResponse([], 'Booking has been deleted successfully.');
            } catch (\Exception $ex) {
                return $this->errorResponse($ex->getMessage(), 500);
            }
        }

    }
}
