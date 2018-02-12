<div class="tab-pane" id="facebook">
    @if(filter_var($entreprise->about->facebook, FILTER_VALIDATE_URL) && $entreprise->une )
        <iframe src="https://www.facebook.com/plugins/page.php?href={{$entreprise->about->facebook}}&tabs=timeline&width=500&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=118677141494341" width="500" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
    @endif
</div>