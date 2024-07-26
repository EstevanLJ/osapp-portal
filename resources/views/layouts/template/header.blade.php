<!-- .app-header -->
<header class="app-header app-header-dark">
    <!-- .top-bar -->
    <div class="top-bar">
        <!-- .top-bar-brand -->
        <div class="top-bar-brand bg-transparent">
            
            {{-- <a href="index.html"><img src="/template/images/brand-inverse.png" alt="" style="height: 32px;width: auto;"></a> --}}
            <span style="font-weight: bold; color: #fff;">{{ config('app.name') }}</span>

        </div><!-- /.top-bar-brand -->
        <!-- .top-bar-list -->
        <div class="top-bar-list">
            
            <!-- .top-bar-item -->
            <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
                <!-- .nav -->
                {{-- <ul class="header-nav nav">
                    <!-- .nav-item -->
                    <li class="nav-item dropdown header-nav-dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><span class="oi oi-grid-three-up"></span></a>
                        <div class="dropdown-arrow"></div><!-- .dropdown-menu -->
                        <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
                            <!-- .dropdown-sheets -->
                            <div class="dropdown-sheets">
                                <!-- .dropdown-sheet-item -->
                                <div class="dropdown-sheet-item">
                                    <a href="#" class="tile-wrapper"><span class="tile tile-lg bg-indigo"><i
                                                class="oi oi-people"></i></span> <span
                                            class="tile-peek">Teams</span></a>
                                </div><!-- /.dropdown-sheet-item -->
                                <!-- .dropdown-sheet-item -->
                                <div class="dropdown-sheet-item">
                                    <a href="#" class="tile-wrapper"><span class="tile tile-lg bg-teal"><i
                                                class="oi oi-fork"></i></span> <span
                                            class="tile-peek">Projects</span></a>
                                </div><!-- /.dropdown-sheet-item -->
                                <!-- .dropdown-sheet-item -->
                                <div class="dropdown-sheet-item">
                                    <a href="#" class="tile-wrapper"><span class="tile tile-lg bg-pink"><i
                                                class="fa fa-tasks"></i></span> <span class="tile-peek">Tasks</span></a>
                                </div><!-- /.dropdown-sheet-item -->
                                <!-- .dropdown-sheet-item -->
                                <div class="dropdown-sheet-item">
                                    <a href="#" class="tile-wrapper"><span class="tile tile-lg bg-yellow"><i
                                                class="oi oi-fire"></i></span> <span class="tile-peek">Feeds</span></a>
                                </div><!-- /.dropdown-sheet-item -->
                                <!-- .dropdown-sheet-item -->
                                <div class="dropdown-sheet-item">
                                    <a href="#" class="tile-wrapper"><span class="tile tile-lg bg-cyan"><i
                                                class="oi oi-document"></i></span> <span
                                            class="tile-peek">Files</span></a>
                                </div><!-- /.dropdown-sheet-item -->
                            </div><!-- .dropdown-sheets -->
                        </div><!-- .dropdown-menu -->
                    </li><!-- /.nav-item -->
                </ul><!-- /.nav --> --}}
                <!-- .btn-account -->
                <div class="dropdown">
                    <button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        
                        {{-- <span class="user-avatar user-avatar-md"> --}}
                            {{-- <img src="/template/images/avatars/profile.jpg" alt=""> --}}
                        {{-- </span>  --}}
                        
                        <span class="account-summary pr-lg-4 d-none d-lg-block">
                            <span class="account-name">{{ Auth::user()->name }}</span> 
                            <span class="account-description">{{ Auth::user()->typeDescription }}</span>
                        </span>
                    </button>

                    <div class="dropdown-arrow dropdown-arrow-left"></div>
                    
                    <div class="dropdown-menu">
                        <h6 class="dropdown-header d-none d-md-block d-lg-none">{{ Auth::user()->name }}</h6>
                        <a class="dropdown-item" href="user-profile.html">
                            <span class="dropdown-icon oi oi-person"></span> Perfil
                        </a> 
                        
                        <a class="dropdown-item" href="auth-signin-v1.html" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="dropdown-icon oi oi-account-logout"></span> Sair
                        </a>

                    </div>
                    

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div><!-- /.btn-account -->
            </div><!-- /.top-bar-item -->
        </div><!-- /.top-bar-list -->
    </div><!-- /.top-bar -->
</header><!-- /.app-header -->
