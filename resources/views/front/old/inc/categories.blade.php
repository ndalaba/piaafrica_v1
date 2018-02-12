<section id="categories">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-heading text-center">
                    <h2>CATEGORIES</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($sections as $section)
                <div class="col-md-3 col-sm-6">
                    <div class="category">
                        <div class="category-icon">
                            <i class="{{$section->faimage}}"></i>
                        </div>
                        <h4><a href="#">{{strtoupper($section->section)}}</a></h4>
                        @foreach($section->categories as $cat)
                            <p><a href="{{url('categories/'.$cat->slug)}}">{{$cat->categorie}}</a></p>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        @include('front.inc.largepub')
    </div>
</section><!--End Category-->
