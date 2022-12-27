<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ordem_de_Servico;



class OsController extends Controller
{
    public function __construct( Ordem_de_Servico $ordem_de_servico ){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Ordem_de_Servico::all();
    }

    public function store(Request $request)
    {

        try{
            // Step 1 : Create User
            $ordem_de_servico = new Ordem_de_Servico();
            $ordem_de_servico->nome = $request->nome;
            $ordem_de_servico->nome_artistico = $request->nome_artistico;
            $ordem_de_servico->cnpf_cnpj = $request->cnpf_cnpj;
            $ordem_de_servico->email = $request->email;
            $ordem_de_servico->email2 = $request->email2;
            $ordem_de_servico->data_nascimento = $request->data_nascimento;

            $ordem_de_servico->rua = $request->rua;
            $ordem_de_servico->numero = $request->numero;
            $ordem_de_servico->cep = $request->cep;
            $ordem_de_servico->cidade = $request->cidade;
            $ordem_de_servico->uf = $request->uf;
            $ordem_de_servico->pais = $request->pais;

            $ordem_de_servico->telefone1 = $request->telefone1;
            $ordem_de_servico->telefone2 = $request->telefone2;

            $ordem_de_servico->data_cobranca = $request->data_cobranca;

            $ordem_de_servico->tenant_id = $request->tenant_id;

            $ordem_de_servico->status = $request->status;

            $ordem_de_servico->save();

            DB::commit();

            return $ordem_de_servico;
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
        return Ordem_de_Servico::find($id);
    }


    public function update(Request $request, $id)
    {
        try{

            $ordem_de_servico = Ordem_de_Servico::find($id);

            $ordem_de_servico->placa = $request->placa;
            $ordem_de_servico->ano = $request->ano;
            $ordem_de_servico->modelo = $request->modelo;
            $ordem_de_servico->fabricante = $request->fabricante;
            $ordem_de_servico->cliente = $request->cliente;
            $ordem_de_servico->tenant_id = $request->tenant_id;

            $ordem_de_servico->update();


            DB::commit();

            return $ordem_de_servico;
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

            $ordem_de_servico = Ordem_de_Servico::find($id);
           if($ordem_de_servico){
            $ordem_de_servico->delete();
           }

            DB::commit();

            return $ordem_de_servico;


        }catch(Exception $e){
            DB::rollback();
            return $e;
        }
    }

}
