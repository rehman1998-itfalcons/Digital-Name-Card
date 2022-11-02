<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\MultiTenant;
use App\Models\Role;
use App\Models\User;
use App\Models\Vcard;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class AdminUserController extends AppBaseController
{

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function index()
    {
        return view('admin_users.index');
    }

    /**
     * @param $id
     *
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('admin_users.show', compact('user'));
    }

    /**
     *
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin_users.create');
    }

    /**
     * @param Request $request
     *
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['role'] = Role::ROLE_SUPER_ADMIN;
        $this->userRepo->store($input);

        Flash::success(__('messages.admin.admin_created_successfully'));

        return redirect(route('admins.index'));
    }

    /**
     * @param $id
     *
     *
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin_users.edit', compact('user'));
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     *
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request, $id): Redirector|RedirectResponse|Application
    {
        
        $user = User::findOrFail($id);
    
        $this->userRepo->update($request->all(), $user);

        Flash::success(__('messages.admin.admin_updated_successfully'));

        return redirect(route('admins.index'));
    }

    /**
     * @param User $user
     *
     *
     * @return mixed
     */
    public function destroy(User $user)
    {
        Vcard::where('tenant_id', $user->tenant_id)->delete();
        MultiTenant::where('id', $user->tenant_id)->delete();
        $user->delete();

        return $this->sendSuccess('User deleted successfully.');
    }
}
