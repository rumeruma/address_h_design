<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Welcome;
use App\RoleAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Admin;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:admins',
        ]);

        $r_admin['name'] = $request->input('name');
        $r_admin['email'] = $request->input('email');
        $r_admin['verifyToken'] = Str::random(40);
        $r_admin['password'] = Str::random(8);

        $admin = Admin::create([
            'name' => $r_admin['name'],
            'email' => $r_admin['email'],
            'password' => bcrypt($r_admin['password']),
            'verifyToken' => $r_admin['verifyToken']
        ]);

        $roleadmin = new RoleAdmin();
        $roleadmin->role_id = 2;
        $roleadmin->admin_id = $admin->id;
        $roleadmin->save();

        Mail::to($admin->email)->send(new Welcome($r_admin));

        return array('success' => "user with email: " . $r_admin['email']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAll()
    {
        $users = Admin::all();
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('role', function ($users) {
                return $users->role[0]->name;
            })
            ->editColumn('status', function ($users) {
                return ($users->status == 0) ? '<span class="text-danger">inactive</span>' : '<span class="text-success">active</span>';
            })
            ->addColumn('operations',
                function ($users) {
                    $lock = '<button type="button" class="btn btn-xs btn-danger pl lock" data-id="'.$users->id.'" >
                                    <i class="fa fa-lock"></i> lock user
                                  </button>';
                    $unlock = '<button type="button" class="btn btn-xs btn-success pl unlock" data-id="'.$users->id.'" >
                                    <i class="fa fa-unlock"></i> unlock user
                                  </button>';
                    $filtered = ($users->status == 0) ? $unlock : $lock;
                    $btnaction = ($users->verifyToken == Null && $users->role[0]->name != 'admin') ? $filtered : '';
                    return $btnaction;
                })
            ->rawColumns(['operations', 'status'])
            ->make(true);
    }

    public function users()
    {
        return view('admin.index');
    }

    public function verifyEmail($email, $token)
    {
        $user = Admin::where(['email' => $email, 'verifyToken' => $token])->first();
        if ($user) {
            Admin::where(['email' => $email, 'verifyToken' => $token])->update(['status' => true, 'verifyToken' => null]);
            return redirect(route('admin.login'))
                ->with('status', 'Your account has been activated successfully');
        } else {
            return redirect(route('verify.message'))
                ->with('error', 'Opps! Something went wrong. seems this link has been expired');
        }
    }

    public function userPadlock(Request $request)
    {
        $user = Admin::find($request->input('id'));

        if($request->input('status') == 0){
            Admin::where(['id' => $request->input('id'), 'status' => $request->input('status')])->update(['status' => true]);
            return array('success' => "user with email: " . $user['email']);
        } else{
            Admin::where(['id' => $request->input('id'), 'status' => $request->input('status')])->update(['status' => false]);
            return array('success' => "user with email: " . $user['email']);
        }
    }
}
