<div class="tab-pane @if($response==null) active @endif" id="company-profile">
    <h2>{{$entreprise->domaine}} -  <a href="{{url('entreprise/'.$entreprise->section->slug)}}" title="{{$entreprise->section->section}}">{{$entreprise->section->section}}</a></h2>

    <h5></h5>

    <div class="social-link text-right">
        <ul class="list-inline">
            <li><a href="{{$entreprise->about->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="{{$entreprise->about->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a href="{{$entreprise->about->googleplus}}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="{{$entreprise->about->linkedin}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>

    <div class="company-text">
        {!! nl2br($entreprise->about->description) !!}
    </div>

</div>
