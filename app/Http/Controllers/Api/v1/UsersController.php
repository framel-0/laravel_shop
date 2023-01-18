<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UsersResource;
use App\Models\User;
use App\Repository\IUserRepository;
use App\Traits\HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UsersResource::collection(
            $this->userRepository->all()
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user = $this->userRepository->findById($user_id);

        if (is_null($user)) {
            return $this->error(null, 'User Not Found', Response::HTTP_NOT_FOUND);
        }

        return $this->success(new UsersResource($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, int $user_id)
    {
        $useredit = $this->userRepository->findById($user_id);

        if (is_null($useredit)) {
            return $this->error(null, 'User Not Found', Response::HTTP_NOT_FOUND);
        }

        $useredit->name = is_null($request->get('name')) ? $useredit->name : $request->get('name');
        $useredit->email = is_null($request->get('email')) ? $useredit->email : $request->get('email');
        $useredit->security_level = is_null($request->get('security_level')) ? $useredit->security_level : $request->get('security_level');
        $useredit->email_verified_at = is_null($request->get('email_verified_at')) ? $useredit->email_verified_at : $request->get('email_verified_at');

        $result = $this->userRepository->update($user_id, $useredit->toArray());

        return $this->success($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
