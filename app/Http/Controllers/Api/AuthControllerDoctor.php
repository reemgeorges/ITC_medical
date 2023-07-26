<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;




class AuthControllerDoctor extends Controller
{
    use GeneralTrait;



    /**
     * Display a listing of the resource.
     */
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
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }


        public function login(Request $request)
        {
            // Existing code...

            try {
                $doctor = Doctor::where('doctor_ident', $request->input('doctor_ident'))->firstOrFail();

                if (!Hash::check($request->input('doctor_password'), $doctor->doctor_password)) {
                    return $this->errorResponse('الرقم الوطني أو كلمة المرور غير صحيحة.', 400);
                }

                $token = $doctor->createToken('apiToken')->plainTextToken;

                // Debugging statement to print the generated token
                echo 'Generated Token: ' . $token . PHP_EOL;

                $data['token'] = $token;
                $data['name'] = $doctor->doctor_name;

                return $this->successResponse($data, 'تم تسجيل دخول المستخدم بنجاح.');
            } catch (\Exception $ex) {
                return $this->errorResponse($ex->getMessage(), 500);
            }
        }






        public function logout(Request $request)
{
    try {
        $doctor = auth('webdoctor')->user();

        if ($doctor) {
            $doctor->tokens()->delete();
            return $this->successResponse([], 'Doctor has logged out successfully.');
        } else {
            return $this->errorResponse('Doctor not authenticated.', 401);
        }
    } catch (\Exception $ex) {
        return $this->errorResponse($ex->getMessage(), 500);
    }

}







    public function register(Request $request)
    {
        {
            $validator = Validator::make($request->all(), [
                'doctor_name' => 'required',
                'doctor_specialty' => 'required',
                'doctor_certificate_image' => 'required',
                'doctor_phone' => 'required|min:10',
                'doctor_password' => 'required|min:4|unique:doctors',
                'doctor_description' => 'required',
                'doctor_ident' => 'required|min:11|unique:doctors',
                'doctor_license_number' => 'required',
                'doctor_license_image' => 'required',
                'address_clinc_doctor' => 'required',
                'clinc_id' => 'required',
            ], [
                'doctor_name.required' => 'اسم الطبيب مطلوب.',
                'doctor_specialty.required' => 'تخصص الطبيب مطلوب.',
                'doctor_certificate_image.required' => 'صورة الشهادة مطلوبة.',
                'doctor_phone.required' => 'رقم الهاتف مطلوب.',
                'doctor_phone.min' => 'يجب أن يحتوي رقم الهاتف على 10 أرقام على الأقل.',
                'doctor_password.required' => 'كلمة السر مطلوبة.',
                'doctor_password.min' => 'يجب أن تحتوي كلمة السر على 4 أحرف على الأقل.',
                'doctor_password.unique' => 'قيمة كلمة السر مكررة. يرجى استخدام قيمة مختلفة.',
                'doctor_description.required' => 'وصف الطبيب مطلوب.',
                'doctor_ident.required' => 'الرقم الوطني مطلوب.',
                'doctor_ident.min' => 'يجب أن يحتوي الرقم الوطني على 11 رقمًا.',
                'doctor_ident.unique' => 'قيمة الرقم الوطني مكررة. يرجى استخدام قيمة مختلفة.',
                'doctor_license_number.required' => 'رقم الترخيص مطلوب.',
                'doctor_license_image.required' => 'صورة الترخيص مطلوبة.',
                'address_clinc_doctor.required' => 'عنوان العيادة مطلوب.',
                'clinc_id.required' => 'معرف العيادة مطلوب.',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 422);
            }

            try {
                $doctor = Doctor::create([
                    'doctor_name' => $request->input('doctor_name'),
                    'doctor_specialty' => $request->input('doctor_specialty'),
                    'doctor_certificate_image' => $request->input('doctor_certificate_image'),
                    'doctor_phone' => $request->input('doctor_phone'),
                    'doctor_password' => Hash::make($request->input('doctor_password')),
                    'doctor_description' => $request->input('doctor_description'),
                    'doctor_ident' => $request->input('doctor_ident'),
                    'doctor_license_number' => $request->input('doctor_license_number'),
                    'doctor_license_image' => $request->input('doctor_license_image'),
                    'address_clinc_doctor' => $request->input('address_clinc_doctor'),
                    'clinc_id' => $request->input('clinc_id'),
                ]);

                // Don't attempt to log in the doctor here.
                // Registration and login are separate processes.
                // The doctor will need to log in separately after registration.

                $data['doctor_name'] = $doctor->doctor_name;
                $data['doctor'] = $doctor;

                return $this->successResponse($data, 'Doctor is registered successfully');
            } catch (\Exception $ex) {
                return $this->errorResponse($ex->getMessage(), 500);
            }
        }


    }
}

