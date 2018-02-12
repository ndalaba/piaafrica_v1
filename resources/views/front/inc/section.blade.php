<div class="page-content">
    <h3>{{ config('application.name') }} <span>Annuaire des entreprises et institutions</span></h3>

    <div class="row clearfix">
        @foreach($homesections as $section)
            <div class="col-md-2 col-sm-4 col-xs-6">
                <div class="category-item">
                    <a href="{{ url('annuaire/'.$section->slug) }}" title="Annuaire entreprise - {{ $section->section }}"><i class="fa {{$section->faimage}} fa-2x"></i>{{ $section->section }}
                    </a>
                </div>
            </div>
        @endforeach
        <div class="view-more">
            <a class="btn btn-default text-center" href="{{ url('annuaire') }}" title="Annuaire entreprises africaines"><i class="fa fa-plus-square-o"></i>Voir toutes les catégories</a>
        </div>
    </div>
</div>
