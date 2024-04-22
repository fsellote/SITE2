<?php

namespace App\Http\Controllers;
//use App\User;
use App\Models\UserJob; 
use Illuminate\Http\Response; 
use App\Traits\ApiResponser;
use Illuminate\Http\Request; 
use DB; 

Class UserJobController extends Controller {

 use ApiResponser;
 private $request;
 public function __construct(Request $request){
 $this->request = $request;
 }
 
 /**
 * Return the list of usersjob
 * @return Illuminate\Http\Response
 */
 public function index()
 {
 $usersjob = UserJob::all();
 return $this->successResponse($usersjob);
 
 }
 /**
 * Obtains and show one userjob
 * @return Illuminate\Http\Response
 */
 public function show($id)
 {
 $userjob = UserJob::findOrFail($id);
 return $this-
successResponse($userjob); 
 }
}