<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserAdmin;



class UserAdminController extends Controller
{
    public function __construct( UserAdmin $user){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return UserAdmin::all();
    }

    public function store(Request $request)
    {

        try{
            // Step 1 : Create User
            $user = new UserAdmin();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            DB::commit();

            return $user;
        }catch(Exception $e){
            DB::rollback();
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return UserAdmin::find($id);
    }


    public function update(Request $request, $id)
    {
        try{

            $user = $this->pecas->findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->tipo = $request->tipo;
            $user->update();


            DB::commit();

            return $user;
        }catch(Exception $e){
            DB::rollback();
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try{

            $user = UserAdmin::find($id);
           if($user){
            $user->delete();
           }

            DB::commit();

            return $user;


        }catch(Exception $e){
            DB::rollback();
            return $e;
        }
    }

}
