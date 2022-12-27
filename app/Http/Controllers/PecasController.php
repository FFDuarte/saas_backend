<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pecas;



class PecasController extends Controller
{
    public function __construct( Pecas $pecas ){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Pecas::all();
    }

    public function store(Request $request)
    {

        try{
            // Step 1 : Create User
            $pecas = new Pecas();
            $pecas->nome = $request->nome;
            $pecas->nome_artistico = $request->nome_artistico;
            $pecas->cnpf_cnpj = $request->cnpf_cnpj;
            $pecas->email = $request->email;
            $pecas->email2 = $request->email2;
            $pecas->data_nascimento = $request->data_nascimento;
        
            $pecas->rua = $request->rua;
            $pecas->numero = $request->numero;
            $pecas->cep = $request->cep;
            $pecas->cidade = $request->cidade;
            $pecas->uf = $request->uf;
            $pecas->pais = $request->pais;

            $pecas->telefone1 = $request->telefone1;
            $pecas->telefone2 = $request->telefone2;

            $pecas->data_cobranca = $request->data_cobranca;

            $pecas->tenant_id = $request->tenant_id;
            
            $pecas->status = $request->status;

            $pecas->save();

            DB::commit();

            return $pecas;
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
        return Pecas::find($id);
    }


    public function update(Request $request, $id)
    {
        try{

            $pecas = Pecas::find($id);
            
            $pecas->placa = $request->placa;
            $pecas->ano = $request->ano;
            $pecas->modelo = $request->modelo;
            $pecas->fabricante = $request->fabricante;
            $pecas->cliente = $request->cliente;
            $pecas->tenant_id = $request->tenant_id;

            $pecas->update();


            DB::commit();

            return $pecas;
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

            $pecas = Pecas::find($id);
           if($pecas){
            $pecas->delete();
           }

            DB::commit();

            return $pecas;


        }catch(Exception $e){
            DB::rollback();
            return $e;
        }
    }

}
