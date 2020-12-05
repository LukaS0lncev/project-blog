@section('widget-subscribe')
<div class="widget subscribe-widget clearfix">
    <div class="dark" style="padding: 25px; background-color: #383838; border-radius: 2px;">
        <div class="fancy-title title-border">
            <h4>Subscribe</h4>
        </div>

        <p style="font-size: 15px; line-height: 1.5; color: #999;">Subscribe to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</p>
        <div class="widget-subscribe-form-result"></div>
        <form id="widget-subscribe-form2" action="http://themes.semicolonweb.com/html/canvas/include/subscribe.php" method="post" class="mb-0">
            <div class="input-group mx-auto">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="icon-email2"></i></div>
                </div>
                <input type="email" id="widget-subscribe-form-email2" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
            </div>
            <button class="button button-3d btn-block button-small m-0" style="margin-top: 15px !important;" type="submit">Subscribe</button>
        </form>
    </div>
</div>
@endsection
