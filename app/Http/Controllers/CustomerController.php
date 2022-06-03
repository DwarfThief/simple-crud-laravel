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
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
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

    private function cleanCNPJ(string $cnpj)
    {
        $cnpj = trim($cnpj);
        return str_replace(array(".", ",", "-", "/"), "", $cnpj);
    }
}
