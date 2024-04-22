<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserJob;

Class UserController extends Controller {

    use ApiResponser;

    private $request;

    public function __construct(Request $request){
    $this->request = $request;
    }


    //GET USER


    public function getUsers(){
    $users = User::all();
    return response()->json($users, 200);
    }

    //INDEXING

    public function index()
        {
        $users = User::all();
        return $this->successResponse($users);
        
    }

    // ADD USER

    public function add(Request $request ){
        $rules = [
        'username' => 'required|max:20',
        'password' => 'required|max:20',
        'gender' => 'required|in:Male,Female',
        'jobid' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request,$rules);
        $userjob = UserJob::findOrFail($request->jobid);
        $user = User::create($request->all());
        return $this->successResponse($user, Response::HTTP_CREATED);
        }

    // SHOW ID INFORMATION

    public function show($id)
        {
        $user = User::findOrFail($id);
        return $this->successResponse($user);
    }

    // UPDATE USER

    public function update(Request $request,$id) {
        $rules = [
        'username' => 'max:20',
        'password' => 'max:20',
        'gender' => 'in:Male,Female',
        'jobid' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request, $rules);
        // validate if Jobid is found in the table tbluserjob
        $userjob =  UserJob::findOrFail($request->jobid);
        $user = User::findOrFail($id);

        $user->fill($request->all());
        // if no changes happen
        if ($user->isClean()) {
        return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->successResponse($user);
        }

    //DELETE USER

    public function delete($id)
        {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->successResponse($user);
    }

}