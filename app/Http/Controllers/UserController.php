<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;


class UserController extends Controller

{
    function __construct()

    {

         $this->middleware('permission:قائمة-المستخدمين|انشاء-مستخدم|تعديل-مستخدم|حذف-مستخدم', ['only' => ['index','show']]);

         $this->middleware('permission:انشاء-مستخدم', ['only' => ['create','store']]);

         $this->middleware('permission:تعديل-مستخدم', ['only' => ['edit','update']]);

         $this->middleware('permission:حذف-مستخدم', ['only' => ['destroy']]);

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request): View

    {
        return view("users.index", ['users' => User::all()]);

    }



    public function create(): View

    {

    // $roles = Role::pluck('name','name')->all();
    // return view('users.create',compact('roles'));z
    $user = new User();
    $user->name = 'اسم المستخدم هنا';
    $user->email = 'البريد الإلكتروني هنا';
    $user->password = bcrypt('كلمة المرور هنا');
    $user->save();

    $role = Role::findByName('مستخدم');
    $user->assignRole($role);

    return view('users.create');

    }


    public function store(Request $request): RedirectResponse

    {

        $this->validate($request, [

            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'

        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
                        ->with('success','تم أضافة المستخدم بنجاح');

    }


    public function show($id): View

    {
        $user = User::find($id);
        return view('users.show',compact('user'));

    }

    public function edit($id): View

    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id): RedirectResponse

    {
        $this->validate($request, [
             // 'name' => 'required',
             // 'email' => 'required|email|unique:users,email,'.$id,
             // 'password' => 'same:confirm-password',
            'roles' => 'required',
            'active' => 'boolean' // تحقق من أن الحقل active هو قيمة بولية (true/false)

        ]);
        $user = User::find($id);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles')[0]);
        $user->role = $request->input('roles')[0];
        $user->active = $request->active;
        $user->save();
        return redirect()->route('users.index')
            ->with('success','تم تعديل بيانات المستخدم بنجاح');

    }

    public function destroy($id): RedirectResponse

    {

        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','تم حذف المستخدم بنجاح');

    }


}
