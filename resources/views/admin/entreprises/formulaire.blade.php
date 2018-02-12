@extends(((Request::ajax()) ? 'admin.layout-ajax' : 'admin.layout'))
@section('title')
    @parent
    | Editer une entreprise
@stop

@section('content')
    <div id="page-inner" class="entreprises publierApp">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-head-line"> Editer une entreprise
                    @if(!is_null($entreprise->id))
                        <a href="{{ $entreprise->link  }}" target="_blank">Voir</a>
                    @endif

                    <a href="{{ url('admin/entreprises') }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-list-alt"></i> Liste entreprises</a>
                    <a href="{{ url('admin/entreprise-detail/about/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-pencil"></i> A propos</a>
                    <a href="{{ url('admin/entreprises-detail/services/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-tags"></i> Services</a>
                    <a href="{{ url('admin/entreprises-detail/produits/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-cart-plus"></i> Produits</a>
                    <a href="{{ url('admin/entreprises-detail/partenaires/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-user-plus"></i> Partenaires</a>
                    <a href="{{ url('admin/entreprises-detail/adresses/'.$entreprise->id) }}" class="btn btn-primary btn-sm ajax"><i class="fa fa-location-arrow"></i> Adresses</a>
                    <a href="{{url('admin/entreprises/edit/0/0')}}" class="btn btn-info" style="margin-left: 20px; float: right">Ajouter</a>
                </h2>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <p>Entreprise publiée. </p>
                    </div>
                @endif
                @include('admin.errors')
            </div>
            <form action="{{ url('admin/entreprises/store') }}" method="post" id="post" class="form" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ $contact->id }}">
                @if(!is_null($entreprise->id))
                    <input type="hidden" name="id" value="{{$entreprise->id}}">
                @endif
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Details entreprises
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="titre">Entreprise</label>
                                <input type="text" name="name" value="{{$entreprise->name}}" id="name" class="form-control" autocomplete="off">
                                <input name="slug" type="hidden" id="slug" value="{{$entreprise->slug}}" style="font-weight: normal;font-size: 17px;width: 99%;">
                            </div>
                            <div class="form-group">
                                <label for="slogan">Domaine d'activité</label>
                                <input type="text" name="domaine" value="{{$entreprise->domaine}}" id="slogan" class="form-control" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                <label for="ville">email</label>
                                <input type="email" name="email" value="{{$entreprise->email}}" id="email" class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="ville">Phone</label>
                                <input type="text" name="phone" value="{{$adresse->phone}}" id="phone" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="ville">Web</label>
                                <input type="url" name="web" value="{{$entreprise->web}}" id="web" class="form-control" autocomplete="off" placeholder="http://www.monemtreprise.com">
                            </div>
                            <div class="form-group">
                                <label for="country_id">Pays</label>
                                <select name="country_id" id="country_id" required class="form-control">
                                    <option value=""></option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" @if($adresse->ville) @if($country->id==$adresse->ville->country_id) selected @endif @endif>{{ $country->pays }}</option>
                                    @endforeach
                                </select>
                            </div>
                          
                            <div class="form-group">
                                <label for="ville_id">Ville</label>
                                <select name="ville_id" id="ville_id" required class="form-control">
                                    <option value="">Ville</option>
                                    @foreach($villes as $ville)
                                        <option value="{{$ville->id}}" @if($ville->id==$adresse->ville_id) selected @endif>{{ $ville->ville }}</option>
                                    @endforeach
                                    <option value="0">Autre</option>
                                </select>
                                <input type="text" id="ville" class="form-control" style="display: none" name="ville">
                            </div>
                            <div class="form-group">
                                <label for="description">Adresse</label>
                                <textarea name="adresse" id="adresse" class="form-control">{{$adresse->adresse}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Map: <span style="color:#f4645f">ex: 9.514259,-13.710681</span></label>
                                <input type="text" name="map" id="map" class="form-control" placeholder="9.514259,-13.710681" value="{{$entreprise->map}}"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading" onclick="$('#contact_email_body').toggle()" style="cursor: pointer">Contact</div>
                        <div class="panel-body" id="contact_email_body" style="display: none">
                            <input type="email" name="contact_email" id="contact_email" class="form-control" value="{{ $contact->email }}"/>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Section d'entreprise</div>
                        <div class="panel-body">
                            <label for="categorie_id">Section d'entreprise</label>
                            <select name="section_id" id="section_id" required class="form-control">
                                <option value=""></option>
                                @foreach($sections as $section)
                                    <option value="{{$section->id}}" @if($section->id==$entreprise->section_id)selected @endif>{{ $section->section }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Entreprise à la Une</div>
                        <div class="panel-body">
                            <label for="post_status">État&nbsp;:</label>
                            <span id="post-status-display">Entreprise à la une</span>
                            <label class="selectit">
                                <input type="checkbox" name="une" id="in-category-1" @if($entreprise->une) checked @endif>
                            </label>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Publie</div>
                        <div class="panel-body">
                            <label for="post_status">État&nbsp;:</label>
                            <span id="post-status-display">Publié</span>
                            <label class="selectit">
                                <input type="checkbox" name="publie" id="in-category-1" @if($entreprise->publie) checked @endif>
                            </label>
                        </div>
                        <div class="panel-footer">
                            <div class="form-group">
                                <label for="logo">Logo entreprise</label>
                                <input type="file" name="fichier" value="logo" title="logo" id="fichier">
                                <input type="hidden" name="logo" value="{{$entreprise->logo}}" title="logo" id="logo">

                                <p class="help-block">'png', 'gif', 'jpg', 'jpeg'</p>
                            </div>
                            <div class="form-group">
                                <label for="fichierimage">Image entreprise grand format max 800K</label>
                                <input type="file" name="fichierimage" value="fichierimage" title="fichierimage" id="fichierimage">
                                <input type="hidden" name="image" value="{{$entreprise->image}}" title="image">

                                <p class="help-block">'png', 'gif', 'jpg', 'jpeg'</p>
                                <img src="{{$entreprise->imagelink}}" style="max-width: 100%;margin: 5px;" title="logo"/>
                                <img src="{{$entreprise->principaleImagelink}}" style="max-width: 100%;margin: 5px;" title="grande image"/>
                            </div>
                            <input name="save" type="submit" class="btn btn-primary" id="publish" value="Enregistrer">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
