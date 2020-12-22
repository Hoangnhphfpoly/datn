<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        $user = $this->userRepository->fetchData();

        return response()->json($user, 200);
    }

    public function detail(Request $request)
    {
        $user = $this->userRepository->findByName($request->name);

        return response()->json($user, 200);
    }

    public function demo(Request $request){
        $user = $this->userRepository->storeNew($request->all());

        return response()->json($user, 200);
    }

    public function demo2()
    {
//        $user = $this->userRepository->getModel();
        $result = $this->userRepository->whereQuery([['where','name', 'like', 'demoA'], ['orWhere','id', '>', 6]]);

        return view('demo', compact('result'));
    }
}
