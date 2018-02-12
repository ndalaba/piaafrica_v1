@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Editer une annonce
@stop

@section('content')
    @include('admin.inc.tinymce')
    <div id="page-inner" class="annonces publierApp">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Editer une annonce
                    @if(!is_null($annonce->id))
                        <a href="{{ $annonce->link  }}" target="_blank">Voir</a>
                    @endif
                    <a href="{{ url('admin/annonces') }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-list-alt"></i> Liste annonces</a>
                    <a href="{{url('admin/annonces/edit/0')}}" class="btn btn-info" style="margin-left: 20px; float: right">Ajouter</a>
                </h2>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>Annonce publiée. </p>
                    </div>
                @endif
                @include('admin.errors')
            </div>
            <form action="{{ url('admin/annonces/store') }}" method="post" id="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(!is_null($annonce->id))
                    <input type="hidden" name="id" value="{{$annonce->id}}">
                @endif
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Details annonces
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="titre">Annonce</label>
                                <input type="text" name="titre" value="{{$annonce->titre}}" id="titre" class="form-control" autocomplete="off" required>
                                <input name="slug" type="hidden" id="slug" value="{{$annonce->slug}}">
                            </div>
                            <div class="form-group">
                                <label for="type">Type d'offre d'emploi</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">type</option>
                                    <option value="CDI" @if($annonce->type=='CDI') selected @endif>CDI</option>
                                    <option value="CDD" @if($annonce->type=='CDD') selected @endif>CDD</option>
                                    <option value="Intérim" @if($annonce->type=='Intérim') selected @endif>Intérim</option>
                                    <option value="Stage" @if($annonce->type=='Stage') selected @endif>Stage</option>
                                    <option value="Apprentissage/Alternance" @if($annonce->type=='Apprentissage/Alternance') selected @endif>Apprentissage/Alternance</option>
                                    <option value="Indépendant / Freelance / Autoentrepreneur" @if($annonce->type=='Indépendant / Freelance / Autoentrepreneur') selected @endif>Indépendant / Freelance / Autoentrepreneur</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{$annonce->email}}" id="email" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="slogan">Profil</label>
                                <textarea name="profil" id="profil"  class="form-control">{{$annonce->profil}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="slogan">Expérience</label>
                                <input type="text" name="experience" value="{{$annonce->experience}}" id="experience" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="slogan">Date d'expiration</label>
                                <input type="date" name="fin" value="{{$annonce->fin}}" id="fin" class="form-control datepicker" autocomplete="off" >
                            </div>
                            <div class="form-group">
                                <label for="country_id">Pays</label>
                                <select name="country_id" id="country_id" required class="form-control">
                                    <option value=""></option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" @if($annonce->ville) @if($country->id==$annonce->ville->country_id) selected @endif @endif >{{ $country->pays }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ville_id">Ville</label>
                                <select name="ville_id" id="ville_id" required class="form-control">
                                    <option value="">Ville</option>
                                    @foreach($villes as $ville)
                                        <option value="{{$ville->id}}" @if($ville->id==$annonce->ville_id) selected @endif>{{ $ville->ville }}</option>
                                    @endforeach
                                    <option value="0">Autre</option>
                                </select>
                                <input type="text" id="ville" class="form-control" style="display: none" name="ville">
                            </div>
                            <div class="form-group">
                                <label for="description">description</label>
                                <textarea name="description" id="contenu" class="form-control" >{{$annonce->description}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Section de l'annonce</div>
                        <div class="panel-body">
                            <label for="categorie_id">Section de l'annonce</label>
                            <select name="section_id" id="section_id" required class="form-control">
                                <option value=""></option>
                                @foreach($sections as $section)
                                    <option value="{{$section->id}}" @if($section->id==$annonce->section_id)selected @endif>{{ $section->section }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Entreprise annonce</div>
                        <div class="panel-body">
                            <label for="entreprise_id">Entreprise annonce</label>
                            <select name="entreprise_id" id="entreprise_id"  class="form-control">
                                <option value=""></option>
                                @foreach($entreprises as $entreprise)
                                    <option value="{{$entreprise->id}}" @if($entreprise->id==$annonce->entreprise_id)selected @endif>{{ $entreprise->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Annonce à la Une</div>
                        <div class="panel-body">
                            <label for="post_status">État&nbsp;:</label>
                            <span id="post-status-display">Annonce à la une</span>
                            <label class="selectit">
                                <input type="checkbox" name="une" id="in-category-1" @if($annonce->une) checked @endif>
                            </label>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Publie</div>
                        <div class="panel-body">
                            <label for="post_status">État&nbsp;:</label>
                            <span id="post-status-display">Publié</span>
                            <label class="selectit">
                                <input type="checkbox" name="publie" id="in-category-1" @if($annonce->publie) checked @endif>
                            </label>
                        </div>
                        <div class="panel-footer">
                            <input name="save" type="submit" class="btn btn-primary" id="publish" value="Enregistrer">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            $('#entreprise_id').multiselect({
                enableFiltering: true
            });
            $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd'});
        });
    </script>
@stop
