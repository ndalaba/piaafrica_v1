 <nav class="navbar navbar-default navbar-fixed-top navbar-cls-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        @if(Route::current()!=null)
            @if(starts_with(Route::current()->getPath(),'admin'))
                <a class="navbar-brand" href="{{ url('/') }}"><i class="fa fa-home"></i> {{ config('application.name') }}</a>
             @else
                <a class="navbar-brand" href="{{ url('/admin/index') }}"><i class="fa fa-home"></i> {{ config('application.name') }}</a>
            @endif
        @endif
    </div>
    <div class="notifications-wrapper">        
        <ul class="nav navbar-right">
            @if(isset($edit))
                <li><a href="{{ $edit }}">Modifier la page</a></li>
            @endif
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user-plus"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                       <a href="{{url('admin/users/edit/'.Auth::user()->id)}}"><i class="fa fa-user-plus"></i> Modifier mon profil</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ url('administration/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
