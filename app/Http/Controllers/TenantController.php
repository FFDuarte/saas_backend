<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class TenantController extends Controller
{
    public function __construct( Tenant $tenant){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Tenant::all();
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Tenant::find($id);
    }


    public function update(Request $request, $id)
    {
        try{

            $user = Tenant::findOrFail($id);
            $user->id         = $request->id;
            $user->empresa    = $request->empresa;
            $user->cnpf_cnpj  = $request->cnpf_cnpj;
            $user->fantasia   = $request->fantasia;
            $user->logradouro = $request->logradouro;
            $user->numero     = $request->numero;
            $user->bairro     = $request->bairro;
            $user->cidade     = $request->cidade;
            $user->uf         = $request->uf;
            $user->cep        = $request->cep;
            $user->telefone1  = $request->telefone1;
            $user->telefone2  = $request->telefone2;
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

            $user = Tenant::find($id);
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
