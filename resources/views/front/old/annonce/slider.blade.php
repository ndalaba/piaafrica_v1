<div class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
        <div class="image">
            <div id="main_image" style="background-image:url('{{asset('uploads/images/'.$annonce->principale) }}'); ">
            </div>
            <div class="col-md-12" style="margin-top: 20px">
                @foreach($annonce->images as $image)
                    <img src="{{ asset('uploads/images/'.$image->image) }}" alt="{{$annonce->titre}}" onclick="loadImage('{{$image->image}}')"/>
                @endforeach
            </div>
        </div>
    </div>
</div>


<script>
    function loadImage($image) {
        var main_image = document.querySelector('#main_image');
        main_image.style.backgroundImage = "url('" + $url + '/uploads/images/' + $image + "')";
    }
</script>