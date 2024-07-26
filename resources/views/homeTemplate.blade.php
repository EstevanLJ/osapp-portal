@extends('layouts.template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!
            </div>
        </div>
    </div>
</div>

<div class="page-section">
    <div class="card card-fluid">
        <div class="card-body">
            <table id="dt-responsive" class="table dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Extn.</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Extn.</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="/template/javascript/pages/dataTables.bootstrap.min.js"></script>

    <script>
        // DataTables Demo
        // =============================================================

        class DataTablesResponsiveDemo {

            constructor() {

                this.init()

            }

            init() {

                // event handlers
                this.table = this.table()
            }

            table() {
                let tableApi = $('#dt-responsive').DataTable({
                    ajax: '/template/data/ajax-dt.json',
                    responsive: true,
                    dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
                      <'table-responsive'tr>
                      <'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>`,
                    language: {
                        paginate: {
                            previous: '<i class="fa fa-lg fa-angle-left"></i>',
                            next: '<i class="fa fa-lg fa-angle-right"></i>'
                        }
                    },
                    columns: [{
                            data: 'name'
                        },
                        {
                            data: 'position'
                        },
                        {
                            data: 'office'
                        },
                        {
                            data: 'start_date'
                        },
                        {
                            data: 'extn'
                        },
                        {
                            data: 'salary'
                        }
                    ]
                })

                return tableApi
            }
        }


        /**
         * Keep in mind that your scripts may not always be executed after the theme is completely ready,
         * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
         */
        $(document).on('theme:init', () => {
            let q = new DataTablesResponsiveDemo()
        })

    </script>
@endpush
