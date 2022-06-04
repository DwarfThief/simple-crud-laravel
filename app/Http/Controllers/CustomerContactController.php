<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerContact;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerContactRequest;

class CustomerContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer)
    {
        // Selecionando todos os CustomerContacts que possuem relação com o Customer
        $contacts = $customer->contact;

        return view('customer-contacts.index', [
            'customer' => $customer,
            'contacts' => $contacts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CustomerContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerContactRequest $request, Customer $customer)
    {
        $customer->contact()->create([
            'nome_contact' => $request->name,
            'email_contact' => $request->email,
            'cpf' => $this->cleanCpf($request->cpf),
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
     * @param  \App\Models\CustomerContact  $customerContact
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer, CustomerContact $contact)
    {
        return view('customer-contacts.edit', ['customer' => $customer,'customerContact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerContactRequest  $request
     * @param  \App\Models\CustomerContact                $customerContact
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerContactRequest $request, Customer $customer, CustomerContact $contact)
    {
        $contact->nome_contact = $request->name;
        $contact->email_contact = $request->email;
        $contact->cpf = $this->cleanCpf($request->cpf);

        $contact->save();

        $alert = [
            'type' => 'success',
            'msg' => 'Contato atualizado com sucesso',
        ];
        return redirect()->route('contact.index', ['customer' => $customer->id])->with(compact('alert'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer $customer
     * @param  int                  $customerContact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer, int $customerContact)
    {
        $customer->contact()
            ->where('id', $customerContact)
            ->first()
            ->delete();

        $alert = [
            'type' => 'success',
            'msg' => 'Contato excluído com sucesso',
        ];
        return redirect()->back()->with(compact('alert'));
    }

    /**
     * Receive an string with CPF structure and return a string with just the numbers.
     *
     * @param  string $cpf
     * @return string
     */
    private function cleanCpf(string $cpf)
    {
        $cpf = trim($cpf);
        return str_replace(array(".", ",", "-", "/"), "", $cpf);
    }
}
