@extends('layouts.template')

@section('content')

<div class="page-section">
    <div class="card card-fluid">
        <div class="card-body">

            <h5>Formulários Enviados</h5>
            <hr>

            <form action="{{ route('forms.index') }}" method="GET">
            <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <div class="has-clearable">
                                <button type="button" class="close" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times-circle"></i></span>
                                </button> 
                                <input type="text" class="form-control" name="os" id="tf4" placeholder="Número da OS" value="{{ $os }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

            <table id="dt-responsive" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Número da OS</th>
                        <th>Status</th>
                        <th>Usuario</th>
                        <th>Descrição Atividade</th>
                        <th>Data Envio</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @foreach ($forms as $f)
                    <tr>
                        <td>{{ $f->id }}</td>
                        <td>{{ $f->numero_os }}</td>
                        <td>{{ $f->statusDescricao }}</td>
                        <td>{{ $f->usuario->name }}</td>
                        <td>{{ $f->descricao_atividade }}</td>
                        <td>{{ $f->created_at }}</td>
                        <td>
                            @if($f->status === 'PROCESSED')
                                <a href="{{ route('forms.pdf', $f->id ) }}" target="_blank" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-print"></i> <span class="sr-only">Download PDF</span></a>
                            @endif
                            @if($f->status === 'PROCESSED' && Auth::user()->type === 'ADMIN')
                                <a href="{{ route('forms.pdf', [$f->id, 'remake' => 1] ) }}" target="_blank" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-undo"></i> <span class="sr-only">Refazer PDF</span></a>
                            @endif
                            <a href="{{ route('forms.show', $f->id ) }}" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-search"></i> <span class="sr-only">Acessar</span></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="/template/javascript/pages/dataTables.bootstrap.min.js"></script>

    <script>
        class DataTables {
            constructor() {
                this.init()
            }

            init() {
                this.table = this.table()
            }

            table() {
                let tableApi = $('#dt-responsive').DataTable({
                    responsive: true,
                    dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
                      <'table-responsive'tr>
                      <'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>`,
                    language: datatable_language,
                    order: [0, 'desc']
                })

                return tableApi
            }
        }
        $(document).on('theme:init', () => {
            let q = new DataTables()
        })
    </script>
@endpush
