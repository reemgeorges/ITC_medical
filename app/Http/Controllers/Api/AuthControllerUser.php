<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator ;

use function PHPUnit\Framework\isEmpty;

class AuthControllerUser
{
    use GeneralTrait;
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:4|unique:users',
            'user_ident' => 'required|min:11|unique:users',
            'user_phone' => 'required|min:10',
        ], [
                'password.unique' => 'قيمة كلمة السر مكررة. يرجى استخدام قيمة مختلفة.',
                'user_ident.unique' => 'قيمة الرقم الوطني مكررة. يرجى استخدام قيمة مختلفة.',
                'user_phone.min' => 'يجب أن يحتوي رقم الهاتف على 10 أرقام على الأقل.',
            ]);



        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        try {

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $data['token'] = $user->createToken('MyApp')->plainTextToken;
            $data['name'] = $user->name;
            $data['user'] = $user;
            return $this->successResponse($data, 'User is registered successfully');
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:4',
            'user_ident' => 'required|min:11',
        ], [
                'password.required' => 'حقل كلمة السر مطلوب.',
                'password.min' => 'يجب أن تتكون كلمة السر من 4 أحرف على الأقل.',
                'user_ident.required' => 'حقل الرقم الوطني مطلوب.',
                'user_ident.min' => 'يجب أن يحتوي الرقم الوطني على 11 رقمًا على الأقل.',
            ]);


        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        try {
            $user = User::where('user_ident', $request['user_ident'])->first();

            if (!$user || !Hash::check($request['password'], $user->password)) {
                return $this->errorResponse('الرقم الوطني أو كلمة المرور غير صحيحة.', 400);
            }

            $data['token'] = $user->createToken('apiToken')->plainTextToken;
            $data['name'] = $user->name;

            return $this->successResponse($data, 'تم تسجيل دخول المستخدم بنجاح.');

        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }

    }

    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();

        return $this->successResponse([], 'User has logged out successfully.');
    }

}
