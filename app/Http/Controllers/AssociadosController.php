<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Associados;



class AssociadosController extends Controller
{
    public function __construct(private Associados $associados ){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Associados::all();
    }

    public function store(Request $request)
    {

        try{
            // Step 1 : Create User
            $associados = new Associados();
            $associados->nome = $request->nome;
            $associados->nome_artistico = $request->nome_artistico;
            $associados->cnpf_cnpj = $request->cnpf_cnpj;
            $associados->email = $request->email;
            $associados->email2 = $request->email2;
            $associados->data_nascimento = $request->data_nascimento;
        
            $associados->rua = $request->rua;
            $associados->numero = $request->numero;
            $associados->cep = $request->cep;
            $associados->cidade = $request->cidade;
            $associados->uf = $request->uf;
            $associados->pais = $request->pais;

            $associados->telefone1 = $request->telefone1;
            $associados->telefone2 = $request->telefone2;

            $associados->data_cobranca = $request->data_cobranca;

            $associados->tenant_id = $request->tenant_id;

            $associados->save();

            DB::commit();

            return $associados;
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
        return Associados::find($id);
    }


    public function update(Request $request, $id)
    {
        try{

            $associados = Associados::find($id);
            $associados->nome = $request->nome;
            $associados->nome_artistico = $request->nome_artistico;
            $associados->cnpf_cnpj = $request->cnpf_cnpj;
            $associados->email = $request->email;
            $associados->email2 = $request->email2;
            $associados->data_nascimento = $request->data_nascimento;
        
            $associados->rua = $request->rua;
            $associados->numero = $request->numero;
            $associados->cep = $request->cep;
            $associados->cidade = $request->cidade;
            $associados->uf = $request->uf;
            $associados->pais = $request->pais;

            $associados->telefone1 = $request->telefone1;
            $associados->telefone2 = $request->telefone2;

            $associados->data_cobranca = $request->data_cobranca;

            $associados->tenant_id = $request->tenant_id;

            $associados->update();


            DB::commit();

            return $associados;
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

            $associados = Associados::find($id);
           if($associados){
            $associados->delete();
           }

            DB::commit();

            return $associados;


        }catch(Exception $e){
            DB::rollback();
            return $e;
        }
    }

}
