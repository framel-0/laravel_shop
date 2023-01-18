<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Enums\AppUserAbility;
use App\Enums\AppUserSecurityLevel;
use App\Models\User;
use App\Repository\IUserRepository;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use HttpResponse;

    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\LoginUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('', 'The provided credentials are incorrect.', 401);
        }

        $user = User::where('email', $request->email)->first();

        $abilities = $this->getSecurityLevelAbilities($user->security_level);

        $token = $user->createToken('API Token of ' . $user->name, $abilities);

        return $this->success([
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
    } 

    function getSecurityLevelAbilities(AppUserSecurityLevel $securityLevel): array
    {
        if ($securityLevel == AppUserSecurityLevel::Basic) {
            return [
                AppUserAbility::CategoryGet,
                AppUserAbility::LocationGet,
                AppUserAbility::UnitOfMeasureGet,
                AppUserAbility::ItemGet
            ];
        } else if ($securityLevel == AppUserSecurityLevel::Moderator) {
            return [
                AppUserAbility::CategoryGet, AppUserAbility::CategoryCreate,
                AppUserAbility::LocationGet,
                AppUserAbility::UnitOfMeasureGet, AppUserAbility::UnitOfMeasureCreate,
                AppUserAbility::ItemGet
            ];
        } else if ($securityLevel == AppUserSecurityLevel::Admin) {
            return [
                AppUserAbility::UserGet,
                AppUserAbility::CategoryGet, AppUserAbility::CategoryCreate,
                AppUserAbility::LocationGet, AppUserAbility::LocationCreate,
                AppUserAbility::UnitOfMeasureGet, AppUserAbility::UnitOfMeasureCreate,
                AppUserAbility::ItemGet
            ];
        } else if ($securityLevel == AppUserSecurityLevel::SuperAdmin) {
            return [
                AppUserAbility::UserGet, AppUserAbility::UserUpdate,
                AppUserAbility::CategoryGet, AppUserAbility::CategoryCreate, AppUserAbility::CategoryUpdate,
                AppUserAbility::LocationGet, AppUserAbility::LocationCreate, AppUserAbility::LocationUpdate,
                AppUserAbility::UnitOfMeasureGet, AppUserAbility::UnitOfMeasureCreate, AppUserAbility::UnitOfMeasureUpdate,
                AppUserAbility::ItemGet, AppUserAbility::ItemCreate, AppUserAbility::ItemUpdate,
            ];
        } else {
            return [];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have successfully been loged out'
        ]);
    }
}
