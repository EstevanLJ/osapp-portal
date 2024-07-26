@extends('layouts.template')

@section('content')

<div class="page-section">
    <div class="card card-fluid">
        <div class="card-body">

            <a href="{{ route('users.create') }}"class="btn btn-primary float-right"><i class="fa fa-plus"></i> Adicionar</a>
            <h5>Usuários</h5>
            <hr>

            <table id="dt-responsive" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Habilitado</th>
                        <th>Tipo</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @foreach ($users as $u)
                    <tr>
                        <td>{{ $u->id }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->enabled ? 'Sim' : 'Não' }}</td>
                        <td>{{ $u->typeDescription }}</td>
                        <td>{{ $u->created_at }}</td>
                        <td>
                            <a href="{{ route('users.edit', $u->id ) }}" class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-pencil-alt"></i> <span class="sr-only">Editar</span></a>
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
                })

                return tableApi
            }
        }
        $(document).on('theme:init', () => {
            let q = new DataTables()
        })
    </script>
@endpush