<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\u;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        $user = $this->userRepository->fetchAll(['hasRole'], ['age', 'asc']);

        return response()->json(['users' => $user, 'status' => 200], 200);
    }

    public function detail(Request $request)
    {
        $user = $this->userRepository->findById($request->id, []);

        return response()->json(['user' => $user, 'status' => 200], 200);
    }

//    public function demo(Request $request){
//        $user = $this->userRepository->storeNew($request->all());
//
//        return response()->json($user, 200);
//    }

    public function demo(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $user = $this->userRepository->storeNew($request->all());

            $detail = User::where('id', 12345)->firstOrFail();

            DB::commit();
            return response()->json($detail, 200);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json($e, 204);
        }
    }

    public function delete($id)
    {
        $result = $this->userRepository->deleteById($id);
        return response()->json($result, 200);
    }
}
