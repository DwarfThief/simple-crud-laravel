<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('customer.index', ['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $cnpj = $this->cleanCNPJ($request->cnpj);

        if (Customer::where('cnpj', $cnpj)->first()) {
            $alert = [
                'type' => 'danger',
                'msg' => 'CNPJ já cadastrado'
            ];

            return redirect()->back()->with(compact('alert'));
        }

        Customer::create([
            'nome' => $request->name,
            'cnpj' => $cnpj,
            'status' => 0,
        ]);

        $alert = [
            'type' => 'success',
            'msg' => 'Cadastro realizado com sucesso',
        ];
        return redirect()->back()->with(compact('alert'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->nome = $request->name;
        $customer->cnpj = $this->cleanCNPJ($request->cnpj);

        $customer->save();

        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            'App\Models\CustomerContact'::where('id_customer', $customer->id)->delete();

            $customer->delete();

            $alert = [
                'type' => 'success',
                'msg' => 'Cliente excluído com sucesso',
            ];
            return redirect()->back()->with(compact('alert'));
        } catch (\Throwable $th) {
            $alert = [
                'type' => 'alert',
                'msg' => 'Não foi possível excluir o cliente.',
            ];
            return redirect()->back()->with(compact('alert'));
        }
    }

    /**
     * Switch the status of the customer
     *
     * @param \Illuminate\Http\Request $request
     */
    public function changeStatus(Request $request, Customer $customer)
    {
        try {
            $customer = Customer::findOrFail($request->id);

            if ($customer) {
                switch ($customer->status) {
                    case 1:
                        $customer->status = 0;
                        $customer->save();

                        $activated = false;
                        break;
                    case 0:
                        $customer->status = 1;
                        $customer->save();

                        $activated = true;
                        break;
                }

                return response()->json([
                    "sucess" => "true",
                    "activated" => $activated,
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "sucess" => "false",
                "textMessage" => $th,
            ]);
        }
    }

    /**
     * Receiving an string with CNPJ structure and returning with just the numbers.
     *
     * @param  string $cnpj
     * @return string
     */
    private function cleanCNPJ(string $cnpj)
    {
        $cnpj = trim($cnpj);
        return str_replace(array(".", ",", "-", "/"), "", $cnpj);
    }
}
