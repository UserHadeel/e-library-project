<?php


namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class Authentication extends BaseController {

    function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' =>  $request->password])){
           return $this->sendResponse(Auth::user(),'login is ok');
        }else{
            return $this->sendError('login is not ok');
        }
    }

    public function delete(Request $request, $id){
    $validatedData = $request->validate([
        'password' => 'required',
    ]);

    $user = User::find($id);

    if ($user) {

        // التحقق من صحة كلمة المرور
        if ($validatedData['password'] == $user->password) {
            $user->delete();
            return $this->sendResponse([], 'تم حذف المستخدم بنجاح');
        } else {
            return $this->sendError('كلمة المرور غير صحيحة');
        }
    } else {
        return $this->sendError('لم يتم العثور على المستخدم');
    }
}




    // public function delete($id)
    // {
    //     $user = User::find($id);
    //     $user->delete();
    //     return $this->sendResponse($user,'User deleted successfully');
    // }
}
