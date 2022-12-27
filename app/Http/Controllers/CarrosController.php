<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Carros;



class CarrosController extends Controller
{
    public function __construct( Carros $carros ){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return carros::all();
    }

    public function store(Request $request)
    {

        try{
            // Step 1 : Create User
            $carros = new Carros();
            $carros->nome = $request->nome;
            $carros->nome_artistico = $request->nome_artistico;
            $carros->cnpf_cnpj = $request->cnpf_cnpj;
            $carros->email = $request->email;
            $carros->email2 = $request->email2;
            $carros->data_nascimento = $request->data_nascimento;
        
            $carros->rua = $request->rua;
            $carros->numero = $request->numero;
            $carros->cep = $request->cep;
            $carros->cidade = $request->cidade;
            $carros->uf = $request->uf;
            $carros->pais = $request->pais;

            $carros->telefone1 = $request->telefone1;
            $carros->telefone2 = $request->telefone2;

            $carros->data_cobranca = $request->data_cobranca;

            $carros->tenant_id = $request->tenant_id;
            
            $carros->status = $request->status;

            $carros->save();

            DB::commit();

            return $carros;
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
        return Carros::find($id);
    }


    public function update(Request $request, $id)
    {
        try{

            $carros = Carros::find($id);
            
            $carros->placa = $request->placa;
            $carros->ano = $request->ano;
            $carros->modelo = $request->modelo;
            $carros->fabricante = $request->fabricante;
            $carros->cliente = $request->cliente;
            $carros->tenant_id = $request->tenant_id;

            $carros->update();


            DB::commit();

            return $carros;
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

            $carros = Carros::find($id);
           if($carros){
            $carros->delete();
           }

            DB::commit();

            return $carros;


        }catch(Exception $e){
            DB::rollback();
            return $e;
        }
    }

}
