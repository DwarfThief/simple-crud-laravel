@extends('layout.app', [
    'title' => 'Simple Crud',
    'scripts' => [
        'js/jquery.mask.js',
        'js/mask.js',
    ],
])

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header mb-0">
                Edição de cliente
            </h2>
            <form class="pt-2 form-group flex flex-row container" action="{{ route('customer.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="mb-3 col-md-3 col-sm-12">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="cnpj form-control @if ($errors->first('cnpj')) {{ 'is-invalid' }} @endif"
                            id="cnpj" name="cnpj" value="{{ preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', "\$1.\$2.\$3/\$4-\$5", $customer['cnpj']) }}">
                        @if ($errors->first('cnpj'))
                            <div class="invalid-feedback">{{ $errors->first('cnpj') }}</div>
                        @endif
                    </div>

                    <div class="mb-3 col-md-8 col-sm-12">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control @if ($errors->first('name')) {{ 'is-invalid' }} @endif"
                            name="name" id="name" value="{{ $customer->nome }}">
                        @if ($errors->first('name'))
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                </div>
                <div class="flex pb-3">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-success bold">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
