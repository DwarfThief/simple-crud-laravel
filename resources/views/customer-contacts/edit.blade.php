@extends('layout.app', [
    'title' => 'Simple Crud | Contatos',
    'scripts' => ['js/jquery.mask.js', 'js/mask.js'],
])

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header mb-0">
                Edição de contato
            </h2>
            <form class="pt-2 form-group flex flex-row container" method="POST"
                action="{{ route('contact.update', [
                    'customer' => $customer->id,
                    'contact' => $customerContact->id,
                ]) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="mb-3 col-md-3 col-sm-12">
                        <label for="cpf">CPF</label>
                        <input type="text"
                            class="cpf form-control @if ($errors->first('cpf')) {{ 'is-invalid' }} @endif" id="cpf"
                            name="cpf" value="{{ $customerContact->cpf }}">
                        @if ($errors->first('cpf'))
                            <div class="invalid-feedback">{{ $errors->first('cpf') }}</div>
                        @endif
                    </div>

                    <div class="mb-3 col-md-8 col-sm-12">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @if ($errors->first('name')) {{ 'is-invalid' }} @endif"
                            name="name" id="name" value="{{ $customerContact->nome_contact }}">
                        @if ($errors->first('name'))
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-8 col-sm-12">
                        <label for="email">E-mail</label>
                        <input type="email"
                            class="form-control @if ($errors->first('email')) {{ 'is-invalid' }} @endif" name="email"
                            id="email" value="{{ $customerContact->email_contact }}">
                        @if ($errors->first('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="mb-3 d-flex col-md-3 col-sm-12 align-items-end justify-content-end">
                        <button type="submit" class="btn btn-outline-success bold">Editar contato</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
