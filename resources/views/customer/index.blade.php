@extends('layout.app', [
    'title' => 'Simple Crud',
    'scripts' => ['js/jquery.mask.js', 'js/mask.js', 'js/change-status.js'],
])

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header mb-0">
                Cadastro de clientes
            </h2>
            <form class="pt-2 form-group flex flex-row container" action="{{ route('customer.store') }}" method="POST">
                @csrf
                @method('POST')

                <div class="row">
                    <div class="mb-3 col-md-3 col-sm-12">
                        <label for="cnpj">CNPJ</label>
                        <input type="text"
                            class="cnpj form-control @if ($errors->first('cnpj')) {{ 'is-invalid' }} @endif" id="cnpj"
                            name="cnpj" value="{{ old('cnpj') }}">
                        @if ($errors->first('cnpj'))
                            <div class="invalid-feedback">{{ $errors->first('cnpj') }}</div>
                        @endif
                    </div>

                    <div class="mb-3 col-md-8 col-sm-12">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @if ($errors->first('name')) {{ 'is-invalid' }} @endif"
                            name="name" id="name" value="{{ old('name') }}">
                        @if ($errors->first('name'))
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                </div>
                <div class="flex pb-3">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-success bold">Cadastrar cliente</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="p-3 container">
        <div class="card">
            <h2 class="mb-0 card-header">
                Clientes
            </h2>
            <table class="p-4 table table-inverse m-4 w-auto">
                <thead class="thead-inverse">
                    <tr>
                        <th>Status</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>
                                @if ($customer->status == 1)
                                    <button id="{{ $customer->id }}" name="status-button"
                                        class="pr-3 btn btn-success">Ativo</button>
                                @else
                                    <button id="{{ $customer->id }}" name="status-button"
                                        class="btn btn-outline-primary">Desativado</button>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('contact.index', $customer['id']) }}">
                                    {{ $customer['nome'] }}
                                </a>
                            </td>
                            <td>{{ preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', "\$1.\$2.\$3/\$4-\$5", $customer['cnpj']) }}
                            </td>
                            <td>
                                <div class="flex pb-3">
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('customer.edit', $customer['id']) }}"
                                            class="btn btn-outline-primary">
                                            Editar
                                        </a>

                                        <form action="{{ route('customer.destroy', $customer['id']) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-outline-danger" type="submit">Deletar</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
