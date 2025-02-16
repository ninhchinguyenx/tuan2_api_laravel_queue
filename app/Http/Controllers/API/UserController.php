<?php

namespace App\Http\Controllers\API;

use App\Events\RegisterSuccess;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Traits\HandleExceptionTrait;
use Illuminate\Http\Response;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HandleExceptionTrait ;
    public function index()
    {
        try {
            $user = User::query()->latest('id')->paginate(5);
            return response()->json([
                'message' => 'Danh sách người dùng',
                'user' => $user
            ]);
        } catch (\Throwable $th) {
            return $this->handleException($th, 'Lấy danh sách người dùng thất bại.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $data = User::query()->create($request->all());
            
            RegisterSuccess::dispatch($data);
            return response()->json([
                'message' => 'Tạo người dùng thành công .',
                'user' => $data
            ]);
        } catch (\Throwable $th) {
            return $this->handleException($th, 'Tạo người dùng thất bại.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = User::query()->findOrFail($id);
            return response()->json([
                'message' => 'Thông tin người dùng có id = ' . $id,
                'user' => $data
            ]);
        } catch (\Throwable $th) {
            return $this->handleException($th, 'Lấy người dùng thất bại.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        try {
            $user = User::query()->findOrFail($id);
            $user->update($request->all());
            return response()->json([
                'message' => 'Sửa người dùng thành công .',
                'user' => $user
            ]);
        } catch (\Throwable $th) {
            return $this->handleException($th, 'Sửa người dùng thất bại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::query()->findOrFail($id);
            $user->delete();
            return response()->json([
                'message' => 'Xóa người dùng thành công.'
            ], Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            return $this->handleException($th, 'Xoá người dùng thất bại.');
        }
    }
}
