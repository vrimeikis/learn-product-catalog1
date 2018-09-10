<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(): View
    {
        $users = $this->userRepository->paginate();
        return view('admin.user.list', compact('users'));
    }


    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.user.create');
    }


    /**
     * @param UserCreateRequest $request
     * @return RedirectResponse
     */
    public function store(UserCreateRequest $request): RedirectResponse
    {
        try {
            $user = $this->userRepository->create([
                'name' => $request->getName(),
                'last_name' => $request->getLastName(),
                'email' => $request->getEmail(),
                'password' => bcrypt($request->getPassword())
            ]);

            return redirect()
                ->route('admin.user.index')
                ->with('status', 'User ' . $user->name . ' created successfully!');
        } catch (\Exception $exception) {
            return redirect()
                ->route('admin.user.create')
                ->with('error', $exception->getMessage());
        }

    }


    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('admin.user.edit', compact('user'));
    }


    /**
     * @param UserUpdateRequest $request
     * @param int $userId
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, int $userId): RedirectResponse
    {
        try {
            $data = [
                'name' => $request->getName(),
                'last_name' => $request->getLastName(),
                'email' => $request->getEmail(),
            ];

            if ($request->updatePassword()) {
                $data['password'] = bcrypt($request->updatePassword());
            }
            $this->userRepository->update($data, $userId);

            return redirect()
                ->route('admin.user.index')
                ->with('status', 'User updated successfully!');
        } catch (\Exception $exception) {
            return redirect()
                ->route('admin.user.create')
                ->with('error', $exception->getMessage());
        }

    }
}
