<?php

namespace App\Http\Controllers;

use App\ModelHasRoles;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Rules\AgentPhoneUniqe;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = User::OrderBy('id', 'DESC')->paginate(500);

        return view('contents.users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'lecturer')
            ->where('name', '!=', 'student')
            ->where('name', '!=', 'sales_agent')
            ->pluck('display_name', 'name')->all();

        return view('contents.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            //'title' => 'required',
            'roles' => 'required',
            //'organization' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password|min:6',
            'confirm_password' => 'required|min:6',
            'image' => 'nullable|mimes:jpeg,png,jpg',
            'phone' => 'required|min:0|max:10|unique:users,phone',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user = User::find($user->id);
        $user->type = 'admin';
        $user->status = 1;
        $user->save();

        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = decrypt($id);
        $user = User::find($id);

        if (Auth::user()->hasRole('super_admin')) {
            $roles = Role::where('name', '!=', 'lecturer')
                ->where('name', '!=', 'student')
                ->where('name', '!=', 'sales_agent')
                ->pluck('display_name', 'id')->all();
        } else {
            $roles = Role::whereNotIn('name', ['super_admin', 'student', 'lecturer', 'sales_agent'])->pluck('display_name', 'id')->all();
        }

        $userRole = $user->roles->pluck('id')->toArray();

        return view('contents.users.show', compact('user', 'roles', 'userRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        if ((Auth::user()->id == $id) || (Auth::user()->can('user-edit'))) {
            $user = User::find($id);

            if (Auth::user()->hasRole('super_admin')) {
                $roles = Role::where('name', '!=', 'lecturer')
                    ->where('name', '!=', 'student')
                    ->where('name', '!=', 'sales_agent')
                    ->pluck('display_name', 'id')->all();
            } else {
                $roles = Role::whereNotIn('name', ['super_admin', 'student', 'lecturer', 'sales_agent'])->pluck('display_name', 'id')->all();
            }

            $userRole = $user->roles->pluck('id')->toArray();

            return view('contents.users.edit', compact('user', 'roles', 'userRole'));
        } else {
            return redirect('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|same:confirm_password|min:8',
            'phone' => 'required|numeric|unique:users,phone,'.$id,
            'roles' => 'required'
        ]);

        $input = $request->all();

        $user = User::find($id);

        $user->update(
            [
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => ! empty($input['password']) ? Hash::make($input['password']) : $user->password,
                'roles' => $input['roles'],
                'phone' => $input['phone'],
                'status' => isset($request['status']) ? 1 : $request['status1'],
            ]
        );
        // $model_has_permission = ModelHasRoles::where('model_id', $id)->delete();
        $user->roles()->detach();

        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');

        // return redirect()->route('contents.users.index')
        //     ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        User::find($id)->delete();

        return redirect()->route('contents.users.index')
            ->with('success', 'User deleted successfully');
    }

    public function markNotification($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->update (['read_at' => now()]);
            return true;
        }
    }
}
