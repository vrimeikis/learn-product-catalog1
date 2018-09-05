<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->paginate();
        return view('admin.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $this->userRepository->create([
                'name' => $request->getName(),
                'last_name' => $request->getLastName(),
                'email' => $request->getEmail(),
                'password' => bcrypt($request->getPassword())
            ]);

            return redirect()
                ->route('admin.user.index')
                ->with('status', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.user.create')
                ->with('error', $e->getMessage());
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, int $userId)
    {
        try {
            $data = [
                'name' => $request->getName(),
                'last_name' => $request->getLastName(),
                'email' => $request->getEmail(),
            ];
            if($request->getPassword()) {
                $data['password'] = bcrypt($request->getPassword());
            }
            $this->userRepository->update($data, $userId);
            return redirect()
                ->route('admin.user.index')
                ->with('status', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.user.create')
                ->with('error', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
