@extends('layouts.template')

@section('content')

<div class="page-section">
    <div class="card card-fluid">
        <div class="card-body">

            <h5>Jobs Falhados</h5>
            <hr>

            <table id="dt-responsive" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Conexão</th>
                        <th>Fila</th>
                        <th>Falhou em</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                @foreach ($jobs as $j)
                    <tr>
                        <td>{{ $j->id }}</td>
                        <td>{{ $j->connection }}</td>
                        <td>{{ $j->queue }}</td>
                        <td>{{ $j->failed_at }}</td>
                        <td>
                            <button 
                                onclick="abrirModal({{ $j->id }})" 
                                class="btn btn-sm btn-icon btn-secondary"><i class="fa fa-search"></i> <span class="sr-only">Dealhes</span></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div id="modalDetalhesJobFalhado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Erro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
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

        function abrirModal(job) {
            $('#modalDetalhesJobFalhado .modal-body').load('/failedJobs/' + job);
            $('#modalDetalhesJobFalhado').modal('show');
        }
    </script>
@endpush