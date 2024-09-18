<?php

namespace App\Http\Controllers;

use App\Models\CustomersModel;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {

            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'age' => ['required', 'integer', 'min:18'],
                'enterprise' => ['required', 'string', 'max:255'],
                'cpf' => ['nullable'],
                'cpnj' => ['nullable']
            ]);

            $name = $request->input('name');
            $age = $request->input('age');
            $enterprise = $request->input('enterprise');

            $data = [
                'user_id' => Auth::user()->id,
                'name' => $name,
                'age' => $age,
                'enterprise' => $enterprise,
                'cpf' => null,
                'cnpj' => null,

            ];

            // Verifica se deve incluir CPF e/ou CNPJ
            if (isset($validatedData['cpf'])) {
                $data['cpf'] = $validatedData['cpf'];
            }
            if (isset($validatedData['cnpj'])) {
                $data['cnpj'] = $validatedData['cnpj'];
            }

            $store = CustomersModel::create($data);

            return response()->json(['status' => 'sucess', 'message' => 'Cliente cadastrado com sucesso!', 'id' => $store->getKey()], 201);

        } catch (ValidationException $ex) {
            return response()->json(['status' => 'error', 'message' => $ex], 422);
        } catch (Exception $err) {
            return response()->json(['status' => 'error', 'message' => 'Não foi possivel adicionar o cliente a lista do usuário ' . $err], 500);
        }
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'age' => ['required', 'integer', 'min:18'],
                'enterprise' => ['required', 'string', 'max:255'],
                'cpf' => ['nullable', 'string', 'max:18'],
                'cpnj' => ['nullable', 'string', 'cnpj'],
            ]);


            $data = [
                'user_id' => Auth::user()->id,
            ];

            // Verifica se deve incluir CPF e/ou CNPJ
            if ($validatedData['name']) {
                $data['name'] = $validatedData['name'];
            }
            if ($validatedData['age']) {
                $data['age'] = $validatedData['age'];
            }

            if ($validatedData['enterprise']) {
                $data['enterprise'] = $validatedData['enterprise'];
            }


            if ($validatedData['cnpj']) {
                $data['cnpj'] = $validatedData['cnpj'];
            }


            if ($validatedData['cpf']) {
                $data['cpf'] = $validatedData['cpf'];
            }

            $customer = CustomersModel::findOrFail($validatedData['customer_id']);

            if ($customer) {
                $customer->update($data);
            }

            if ($customer === null) {
                return response()->json(['status' => 'error', 'message' => 'Cliente não encontrado!']);
            }

            return response()->json(['status' => 'sucess', 'message' => 'Atualizado com sucesso!']);

        } catch (ValidationException $ex) {
            return response()->json(['status' => 'error', 'message' => $ex], 422);
        } catch (Exception $err) {
            return response()->json(['status' => 'error', 'message' => $err], 500);
        }
    }

    public function pull(): JsonResponse
    {
        try {
            if(Auth::user()){
                $data = Auth::user()->relCustomers()->paginate(10);
                return response()->json(['status' => 'error', 'data' => $data], 200);
            }else{
            return response()->json(['status' => 'error', 'message' => 'Not Autenticate', 'code'=> 401], 401);
            }
        } catch (Exception $err) {
            return response()->json(['status' => 'error', 'message' => $err], 500);
        }


    }

    public function get($id): JsonResponse
    {
        try {
            $customer = Auth::user()->relCustomers()->where('id', $id)->first();
            return response()->json(['status' => 'sucess', 'data' => $customer], 200);
        } catch (Exception $err) {
            return response()->json(['status' => 'error', 'message' => 'Erro: ' . $err], 500);
        }
    }

}
