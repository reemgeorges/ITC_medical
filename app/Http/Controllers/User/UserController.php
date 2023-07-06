<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request , User $user)
     {
         $rules = [
             'name' => 'required',
             'user_phone' => 'required|min:10',
             'city_id' => 'required|exists:cities,id',
             'password' => 'required|min:4',
             'user_ident' => 'required|min:11',
         ];

         $messages = [
             'name.required' => 'حقل الاسم مطلوب.',
             'user_phone.required' => 'حقل رقم الهاتف مطلوب.',
             'user_phone.min' => 'يجب أن يحتوي رقم الهاتف على 10 أرقام على الأقل.',
             'city_id.required' => 'حقل معرف المدينة مطلوب.',
             'city_id.exists' => 'معرف المدينة غير صحيح.',
             'password.required' => 'حقل كلمة المرور مطلوب.',
             'password.min' => 'يجب أن تتكون كلمة المرور من 4 أحرف على الأقل.',
             'user_ident.required' => 'حقل الرقم الوطني مطلوب.',
             'user_ident.min' => 'يجب أن يحتوي الرقم الوطني على 11 رقمًا على الأقل.',
         ];

         $validator = Validator::make($request->all(), $rules, $messages);

         if ($validator->fails()) {
             return $this->errorResponse($validator->errors(), 422);
         }

         try {
             $user = Auth::user();

             // التحقق من صحة التوكن وصحة المستخدم
             if (!$user || $user->id !== $request->user()->id) {
                 return $this->errorResponse('غير مصرح لك بتحديث بيانات هذا المستخدم.', 401);
             }

             $user->name = $request->input('name');
             $user->user_phone = $request->input('user_phone');
             $user->city_id = $request->input('city_id');
             $user->password = Hash::make($request->input('password'));
             $user->user_ident = $request->input('user_ident');
             $user->save();

             $msg = 'تم تحديث بيانات المستخدم بنجاح';
             $userResource = new UserResource($user);

             return $this->successResponse($userResource->toArray($request), $msg);
         } catch (\Exception $ex) {
             return $this->errorResponse($ex->getMessage(), 500);
         }
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }


    public function profile(Request $request)
    {
        // التحقق من صحة التوكن والمستخدم المسجل
        if (!Auth::guard('sanctum')->check()) {
            return $this->errorResponse('توكن غير صالح أو المستخدم غير مسجل.', 401);
        }

        // استعادة المستخدم الحالي
        $user = $request->user();

        // إنشاء مورد المستخدم واستخدامه لتنسيق البيانات بصيغة معينة
        $userResource = new UserResource($user);

        // إرجاع الاستجابة ببيانات المستخدم المعالجة
        return $this->successResponse($userResource->toArray($request), 'تم استرداد بيانات المستخدم بنجاح');
    }
}
