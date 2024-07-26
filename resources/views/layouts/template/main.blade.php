<!-- .app-main -->
<main class="app-main">
    <!-- .wrapper -->
    <div class="wrapper">
        <!-- .page -->
        <div class="page">
            <!-- .page-navs -->
            <nav class="page-navs">
                <!-- .nav-scroller -->
                <div class="nav-scroller">
                    <!-- .nav -->
                    <div class="nav nav-tabs">
                        <a class="nav-link" href="/forms">Envios</a> 
                        <a class="nav-link" href="/users">Usuários</a>

                        @if(Auth::user()->type === 'ADMIN')
                            <a class="nav-link" href="/failedJobs">Jobs Falhados</a>
                        @endif

                    </div><!-- /.nav -->
                </div><!-- /.nav-scroller -->
            </nav><!-- /.page-navs -->
            <!-- .page-inner -->
            <div class="page-inner">
                
                <!-- .page-section -->
                <div class="page-section">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>Sucesso!</strong> {{ session('success') }} 
                        </div>
                    @endif

                    @yield('content')
                
                </div><!-- /.page-section -->

            </div><!-- /.page-inner -->
        </div><!-- /.page -->
    </div><!-- /.wrapper -->

    {{-- @include('layouts.template.footer') --}}

</main><!-- /.app-main -->
