<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Hash;
use DB;
use Yajra\DataTables\Facades\DataTables;
class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:users.index|users.create|users.edit|users.destroy', ['only' => ['index','store']]);
        $this->middleware('permission:users.create', ['only' => ['create','store']]);
        $this->middleware('permission:users.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:users.destroy', ['only' => ['destroy']]);
    }
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_result = $this->form_search($request);
        $users = User::where($search_result)->orderBy('user_type')->paginate(10);

        return view('backend.users.index', compact('users','request'));
    }

    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         \Log::info('AJAX request received');
    //         $data = User::with('role')->select('users.*');

    //         // Apply search filter if search value is present
    //         if ($request->has('search') && !empty($request->search['value'])) {
    //             $searchValue = $request->search['value'];
    //             $data->where(function($query) use ($searchValue) {
    //                 $query->where('name', 'like', "%{$searchValue}%")
    //                     ->orWhere('email', 'like', "%{$searchValue}%")
    //                     ->orWhere('phone', 'like', "%{$searchValue}%")
    //                     ->orWhereHas('role', function ($roleQuery) use ($searchValue) {
    //                         $roleQuery->where('name', 'like', "%{$searchValue}%");
    //                     });
    //             });
    //         }

    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $viewUrl = route('users.show', $row->id);
    //                 $editUrl = route('users.edit', $row->id);
    //                 $deleteUrl = route('users.destroy', $row->id);
    //                 $btn = '<a href="' . $viewUrl . '" class="view btn btn-primary btn-sm">View</a>';
    //                 $btn .= ' <a href="' . $editUrl . '" class="edit btn btn-info btn-sm">Edit</a>';

    //                 // Avoid deleting admin or the current user
    //                 if ($row->id != 1 && auth()->id() != $row->id) {
    //                     $btn .= '
    //                         <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
    //                             ' . csrf_field() . '
    //                             <input type="hidden" name="_method" value="DELETE">
    //                             <button type="submit" class="delete btn btn-danger btn-sm"
    //                             onclick="return confirm(\'Are you sure you want to delete this user?\')">Delete</button>
    //                         </form>
    //                     ';
    //                 }

    //                 return $btn;
    //             })
    //             ->addColumn('role', function($row) {
    //                 return $row->role ? $row->role->name : 'No Role';
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    //     \Log::info('Non-AJAX request received');
    //     return view('backend.users.index');
    // }


    private function form_search($request){
        $search_items = [];

        if ($request->name){
            $search_items[] = ['name', 'like', '%' . $request->name . '%'];
        }
        if ($request->email){
            $search_items[] = ['email', 'like', '%' . $request->email . '%'];
        }
        if ($request->phone){
            $search_items[] = ['phone', 'like', '%' . $request->phone . '%'];
        }
        return $search_items;

    }
    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.users.create', compact('roles'));
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @param StoreUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(User $user,Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status =  $request->status??'Active';
        $user->phone = $request->phone;
        $user->role_id = $request->role;
        $user->save();
        $role = Role::where('id',$request->role)->first();
        $user->assignRole($role->id);
        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('backend.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     *
     * @param User $user
     * @param UpdateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] =bcrypt($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        if($input['role']){
            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            $role = Role::where('id',$input['role'])->first();
            $user->assignRole($role->id);
        }

        return redirect()->route('users.index')
            ->withSuccess(__('User updated successfully.'));
    }
    public function users_list(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function ($user) {
                    return (string)view('backend.users.datatable_users_roles', compact('user'));
                })->rawColumns(['roles'])
                ->addColumn('action', function ($user) {
                    return (string)view('backend.users.datatable_users_action', compact('user'));
                })->rawColumns(['action'])
                ->escapeColumns([])
                ->make(true);
        }
    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}


/*

git clone https://github.com/codeanddeploy/laravel8-authentication-example.git

if your using my previous tutorial navigate your project folder and run composer update



install packages

composer require spatie/laravel-permission
composer require laravelcollective/html

then run php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

php artisan migrate

php artisan make:migration create_posts_table

php artisan migrate

models
php artisan make:model Post

middleware
- create custom middleware
php artisan make:middleware PermissionMiddleware

register middleware
-

routes

controllers

- php artisan make:controller UsersController
- php artisan make:controller PostsController
- php artisan make:controller RolesController
- php artisan make:controller PermissionsController

requests
- php artisan make:request StoreUserRequest
- php artisan make:request UpdateUserRequest

blade files

create command to lookup all routes
- php artisan make:command CreateRoutePermissionsCommand
- php artisan permission:create-permission-routes

seeder for default roles and create admin user
php artisan make:seeder CreateAdminUserSeeder
php artisan db:seed --class=CreateAdminUserSeeder



*/
