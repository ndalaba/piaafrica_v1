<!-- HEADER-LOGIN -->
@if(!Auth::user())
    <div class="header-login hLogin">

        <a href="#" class=""><i class="fa fa-power-off"></i> Se connecter</a>

        <div>
            <form action="{{ url('login') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="email" class="form-control" placeholder="email" required="" name="email">
                <input type="password" class="form-control" placeholder="mot de passe" required="" name="password">
                <input type="checkbox" name="remember" id="remember" style="width: 50px">
                <label for="remember" style="color: #fff">Se souvenir de moi</label>
                <input type="submit" class="btn btn-default" value="Entrer">
                <a href="{{ url('reset-password') }}" class="btn btn-link">Mot de passe oublié</a>
            </form>
        </div>

    </div>
    <!-- END .HEADER-LOGIN -->

    <!-- HEADER REGISTER -->
    <div class="header-register hRegister">
        <a href="#" class=""><i class="fa fa-plus-square"></i> S'incrire</a>

        <div>
            <p style="color:#FFFFFF">Vous êtes à la recherche d'un emploi</p>

            <form action="{{ url('candidat/register') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <select name="country_id" id="country_id" required style="margin-bottom: 15px;">
                    <option value="">Pays</option>
                    @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->pays}}</option>
                    @endforeach
                </select>
                <input type="text" class="form-control" placeholder="nom et prénom" name="name" required="">
                <input type="email" class="form-control" placeholder="Email" required="" name="email">
                <input type="text" class="form-control" placeholder="téléphone" name="phone">
                <input type="password" class="form-control" placeholder="mot de passe" name="password">
                <input type="submit" class="btn btn-default" value="Enregistrer">
            </form>
        </div>

    </div>
@else
    <div class="header-login">

        <a href="{{ url('se-deconnecter') }}" class=""><i class="fa fa-power-off"></i> Se deconnecter</a>

    </div>
    <div class="header-register">
        @if(Auth::user()->droit<config('application.contact'))
            <a href="{{url('candidat/mon-compte')}}" class="" title="{{ Auth::user()->name }}"><i class="fa fa-user"></i> {{ \App\Http\Models\Help::acronym(Auth::user()->name) }}
            </a>
        @else
            <a href="{{url('mon-compte')}}" class="" title="{{ Auth::user()->name }}"><i class="fa fa-user"></i> {{ \App\Http\Models\Help::acronym(Auth::user()->name) }}
            </a>
        @endif
    </div>

@endif
