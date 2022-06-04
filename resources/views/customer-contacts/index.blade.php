@extends('layout.app', [
    'title' => 'Simple Crud | Contatos',
    'scripts' => ['js/jquery.mask.js', 'js/mask.js',],
])

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header mb-0">
                Adicionar contato ao cliente {{ preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', "\$1.\$2.\$3/\$4-\$5", $customer->cnpj) }}
            </h2>
            <form class="pt-2 form-group flex flex-row container" action="{{ route('contact.store', $customer->id) }}" method="POST">
                @csrf
                @method('POST')

                <div class="row">
                    <div class="mb-3 col-md-3 col-sm-12">
                        <label for="cpf">CPF</label>
                        <input type="text"
                            class="cpf form-control @if ($errors->first('cpf')) {{ 'is-invalid' }} @endif" id="cpf"
                            name="cpf" value="{{ old('cpf') }}">
                        @if ($errors->first('cpf'))
                            <div class="invalid-feedback">{{ $errors->first('cpf') }}</div>
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
                <div class="row">
                    <div class="mb-3 col-md-8 col-sm-12">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control @if ($errors->first('email')) {{ 'is-invalid' }} @endif"
                            name="email" id="email" value="{{ old('email') }}">
                        @if ($errors->first('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="mb-3 d-flex col-md-3 col-sm-12 align-items-end justify-content-end">
                        <button type="submit" class="btn btn-outline-success bold">Adicionar contato</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="p-3 container">
        <div class="card">
            <h2 class="mb-0 card-header">
                Contatos
            </h2>
            <table class="p-4 table table-inverse m-4 w-auto">
                <thead class="thead-inverse">
                    <tr>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>
                                {{ preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $contact['cpf']) }}
                            </td>
                            <td>
                                {{ $contact['nome_contact'] }}
                            </td>
                            <td>{{ $contact['email_contact'] }}
                            </td>
                            <td>
                                <div class="flex pb-3">
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ route('contact.edit', ['customer' => $customer->id, 'contact' => $contact['id']]) }}"
                                            class="btn btn-outline-primary">
                                            Editar
                                        </a>

                                        <form action="{{ route('contact.destroy', ['customer' => $customer->id, 'contact' => $contact['id']]) }}" method="post">
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
