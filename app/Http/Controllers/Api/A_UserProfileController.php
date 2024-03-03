<?php


namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class A_UserProfileController extends BaseController
{
    public function index()
    {
        $user = User::all();
        return $this->sendResponse($user,'Return user ');

    }
    public function getUser($id)
    {
        $user = User::where('id','=',$id)->get();
        return $this->sendResponse($user,'Return user ');

    }





    public function edit(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'user' => $user,
        ]);
    }

    // public function update(Request $request, $user_id)
    // {
    //     $user = User::findOrFail($user_id);

    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->password = bcrypt($request->input('password'));
    //     // يجب استخدام دالة bcrypt لتشفير كلمة المرور

    //     $user->save();

    //     return $this->sendResponse($user,'Return user ');

    // }

    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'current_password' => 'required',
            'password' => 'required|min:8',
        ]);

        // التحقق من صحة كلمة المرور الحالية
        if ($validatedData['current_password'] == $user->password) {
            // تحديث البيانات فقط إذا كانت كلمة المرور صحيحة

            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = $validatedData['password'];

            $user->save();

            return $this->sendResponse($user, 'تم تحديث البيانات بنجاح');
        } else {
            return $this->sendError('كلمة المرور الحالية غير صحيحة');
        }
    }

}
