<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Http\Resources\Booking_ClincResource;
use App\Models\Booking_Clinc;
use App\Http\traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Booking_ClincController extends Controller
{

    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    try {
        $userId = Auth::id();
        $bookings = Booking_Clinc::where('user_id', $userId)->get();
        $bookingResource = Booking_ClincResource::collection($bookings);

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
        $request['user_id']=Auth::id();
        $rules = [
            'use_name' => 'required',
            'user_old' => 'required|numeric|min:1',
            'user_phone' => 'required|min:10',
            'user_gender' => 'required|in:0,1',
            'booking_date' => 'required|date',
            'booking_datetime' => 'required|date_format:Y-m-d H:i:s',
            'user_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:doctors,id',
        ];


    $messages = [
        'use_name.required' => 'The name field is required.',
        'user_old.required' => 'The age field is required.',
        'user_old.numeric' => 'The age field must be a number.',
        'user_old.min' => 'The age field must be at least 0.',
        'user_phone.required' => 'The phone number field is required.',
        'user_phone.min' => 'The phone number must be at least 10 characters.',
        'user_gender.required' => 'The gender field is required.',
        'user_gender.in' => 'Invalid gender. Valid values are: male, female.',
        'booking_date.required' => 'The booking date field is required.',
        'booking_date.date' => 'Invalid booking date format.',
        'booking_datetime.required' => 'The booking date and time field is required.',
        'booking_datetime.date_format' => 'Invalid booking date and time format. It should be in Y-m-d H:i:s format.',
        'user_id.required' => 'The user ID field is required.',
        'user_id.exists' => 'Invalid user ID.',
        'doctor_id.required' => 'The doctor ID field is required.',
        'doctor_id.exists' => 'Invalid doctor ID.',
    ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        try {
            $request['booking_status']=0;
            $booking = new Booking_Clinc();
            $booking->use_name = $request->input('use_name');
            $booking->user_old = $request->input('user_old');
            $booking->user_phone = $request->input('user_phone');
            $booking->user_gender = $request->input('user_gender');
            $booking->booking_status = $request->input('booking_status');
            $booking->booking_date = $request->input('booking_date');
            $booking->booking_datetime = $request->input('booking_datetime');
            // $booking->review_booking = $request->input('review_booking');
            $booking->doctor()->associate($request->input('doctor_id'));
            $booking->user()->associate($request->input('user_id'));
            $booking->save();

            $msg = 'Clinic booking created successfully';
            $bookingResource = new Booking_ClincResource($booking);

            return $this->successResponse($bookingResource->toArray($request), $msg);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Booking_Clinc $booking_Clinc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking_Clinc $booking_Clinc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking_Clinc $booking_Clinc)
    {
        //
        try {
            // Check if the authenticated user has the necessary permissions to delete the booking, if needed.
            // Replace 'your_user_permission_check_here' with your actual permission check logic.
            // For example, you may check if the user is the owner of the booking.

            // your_user_permission_check_here($booking);

            $booking_Clinc->delete();
            return $this->successResponse([], 'Booking has been deleted successfully.');
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }
    }

