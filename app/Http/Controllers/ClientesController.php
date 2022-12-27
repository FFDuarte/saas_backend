<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clientes;



class ClientesController extends Controller
{
    public function __construct( Clientes $clientes ){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Clientes::all();
    }

    public function store(Request $request)
    {

        try{
            // Step 1 : Create User
            $clientes = new Clientes();
            $clientes->nome = $request->nome;
            $clientes->nome_artistico = $request->nome_artistico;
            $clientes->cnpf_cnpj = $request->cnpf_cnpj;
            $clientes->email = $request->email;
            $clientes->email2 = $request->email2;
            $clientes->data_nascimento = $request->data_nascimento;

            $clientes->rua = $request->rua;
            $clientes->numero = $request->numero;
            $clientes->cep = $request->cep;
            $clientes->cidade = $request->cidade;
            $clientes->uf = $request->uf;
            $clientes->pais = $request->pais;

            $clientes->telefone1 = $request->telefone1;
            $clientes->telefone2 = $request->telefone2;

            $clientes->data_cobranca = $request->data_cobranca;

            $clientes->tenant_id = $request->tenant_id;

            $clientes->status = $request->status;

            $clientes->save();

            DB::commit();

            return $clientes;
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
        return Clientes::find($id);
    }


    public function update(Request $request, $id)
    {
        try{

            $clientes = Clientes::find($id);

            $clientes->placa = $request->placa;
            $clientes->ano = $request->ano;
            $clientes->modelo = $request->modelo;
            $clientes->fabricante = $request->fabricante;
            $clientes->cliente = $request->cliente;
            $clientes->tenant_id = $request->tenant_id;

            $clientes->update();


            DB::commit();

            return $clientes;
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

            $clientes = Clientes::find($id);
           if($clientes){
            $clientes->delete();
           }

            DB::commit();

            return $clientes;


        }catch(Exception $e){
            DB::rollback();
            return $e;
        }
    }

}
