<nav class="hidden-print navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            @if(Auth::check())
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <!-- keep these span's they create the bootstrap button for the dropdown -->
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            @endif
            @if(Auth::check())
                <a class="navbar-brand" href="{{{ action('HomeController@dashboard')}}}"><img alt="Brand" src="/img/eb_logo-2016.png"></a>
            @else
                <a class="navbar-brand" href="{{{ action('HomeController@ShowWelcome')}}}"><img alt="Brand" src="/img/eb_logo-2016.png"></a>
            @endif
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a> -->
                <!-- <ul class="dropdown-menu"> -->
                    @if(Auth::check())
                    @if(Auth::user()->is_admin)
                        <li><a href="/dashboard">Dashboard</a></li>
                        <li><a href="/createshipment/1">Create New Shipment</a></li>
                        <li><a href="/createuser">Create User</a></li>
                        <li><a href="/edituser">Edit User</a></li>
                        <li><a class="btn btn-primary" href="{{{action('HomeController@doLogout')}}}" role="button">Logout</a></li>
                    @else
                        <li><a href="/dashboard">Dashboard</a></li>
                        <li><a href="/updateInventory/">Update Inventory</a></li>
                        <li><a class="btn btn-primary" href="{{{action('HomeController@doLogout')}}}" role="button">Logout</a></li>
                    @endif
                    @endif
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<input type="hidden" id="auth-check" value="{{{ Auth::check() }}}">

@section('error')
    @if (Session::has('successMessage'))
        <div class="row">
            <div class="alert alert-success" role="alert">
                {{{ Session::get('successMessage') }}}
            </div>
        </div>
    @endif
    @if (Session::has('errorMessage'))
        <div class="row">
            <div class="alert alert-danger" role="alert">
                {{{ Session::get('errorMessage') }}}
            </div>
        </div>
    @endif
@stop
