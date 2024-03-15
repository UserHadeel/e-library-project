<?php


namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class A_UserProfileController extends BaseController
{
    public function index()
    {
        $user = User::all();
        return $this->sendResponse($user,'Return user ');

    }
    public function getUser($user_id)
    {
        $user = User::where('id','=',$user_id)->get();
        return $this->sendResponse($user,'Return user ');

    }

    public function getUserDetails(Request $request): JsonResponse
{
    // $user = $request->user();
    $user = Auth::user();

    $userDetails = [
        'name' => $user->name,
        'email' => $user->email,
        'password' => $user->password,
    ];

    return response()->json($userDetails);
}





    public function edit(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'user' => $user,
        ]);
    }

    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $user->name = $request->input('name');
        // $user->email = $request->input('email');
        if(!empty($request->input('password'))){
            $user->password = bcrypt($request->input('password'));
        }
        
        // يجب استخدام دالة bcrypt لتشفير كلمة المرور

        $user->save();

        return $this->sendResponse($user,'Return user ');

    }


    public function disable(Request $request){

        $validatedData = $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);
    

  
       $user = User::find($validatedData['id']);
      
        if ($user) {
    
           
           // التحقق من صحة كلمة المرور
            if(Hash::check($validatedData['password'],$user->password)){
                $user->active = 0;
                $user->save();
                return $this->sendResponse($user, 'تم حذف المستخدم بنجاح');
             }else{
                return $this->sendError('كلمة المرور غير صحيحة');
             }
        } else {
            return $this->sendError('لم يتم العثور على المستخدم');
        }
    }
    // public function update(Request $request, $user_id)
    // {
    //     $user = User::findOrFail($user_id);

    //     $validatedData = $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'current_password' => 'required',
    //         'password' => 'required|min:8',
    //     ]);

    //     // التحقق من صحة كلمة المرور الحالية
    //     if ($validatedData['current_password'] == $user->password) {
    //         // تحديث البيانات فقط إذا كانت كلمة المرور صحيحة

    //         $user->name = $validatedData['name'];
    //         $user->email = $validatedData['email'];
    //         $user->password = $validatedData['password'];

    //         $user->save();

    //         return $this->sendResponse($user, 'تم تحديث البيانات بنجاح');
    //     } else {
    //         return $this->sendError('كلمة المرور الحالية غير صحيحة');
    //     }
    // }

}
