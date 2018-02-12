<?php
$motivation = "Bonjour,

    Je me permets de vous solliciter pour le poste de « $annonce->titre  » pour lequel je souhaite vous proposer ma candidature. Veuillez trouver en pièce jointe mon Curriculum Vitae.

    Je me tiens à votre disposition pour toutes questions relatives à mon profil.

    Bien cordialement.";
?>

<div class="comments-section">
    <!-- end .comments -->

    <h3>Postuler à l'offre</h3>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (!Session::has('success'))
        <form class="comment-form" method="post" action="{{url('postuler')}}" enctype="multipart/form-data"
        @if(!Auth::user())
            <input type="hidden" name="candidat_id" value="0">
        @else
            <input type="hidden" name="candidat_id" value="{{Auth::user()->id}}">
        @endif
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="annonce_id" value="{{$annonce->id}}">

        <div class="row">
            @if(!Auth::user())
                <div class="col-md-12">
                    <input type="email" placeholder="Email *" name="email" required>
                </div>
                <div class="col-md-12">
                    <input type="text" placeholder="Votre nom" name="name" required>
                </div>
            @else
                <div class="col-md-12">
                    <input type="hidden" placeholder="Email *" name="email" required value="{{Auth::user()->email}}">
                </div>
                <div class="col-md-12">
                    <input type="hidden" placeholder="Votre nom" name="name" required value="{{Auth::user()->name}}">
                </div>
            @endif

            <div class="col-md-12">
                @if(!Auth::user())
                    <em>Votre cv Taille max. de {{config('application.image_size_help')}}. Formats acceptés : .doc, .docx, .pdf, .rtf</em>
                @elseif(Auth::user()->candidat)
                    <em>Utilise mon cv
                        <a href="{{asset('uploads/candidats/cv/'.Auth::user()->candidat->cvdoc)}}" style="color: #005684">{{Auth::user()->candidat->cvdoc}}</a>
                        <br/> ou Télécharger un autre CV Formats acceptés : .doc, .docx, .pdf, .rtf</em>
                @else
                    <em>Votre cv Taille max. de {{config('application.image_size_help')}}. Formats acceptés : .doc, .docx, .pdf, .rtf</em>
                @endif
                <input type="file" title="votre cv Taille max. de 2 Mo. Formats acceptés : .doc, .docx, .pdf, .rtf" name="cv">
            </div>
        </div>

        <textarea placeholder="Lettre de motivation ou message d'accompagnement (optionnel)" required="" name="motivation">
      {{ $motivation }}
    </textarea>

        <button type="submit" class="btn btn-default"><i class="fa fa-envelope-o"></i> Postuler</button>
        </form>
    @endif

</div>
