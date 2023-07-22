<!-- Start: Preloader -->
<section id="preloader-section">
    <div id="preloader">
        <div id="ctn-preloader" class="ctn-preloader loader-section">
            <div class="animation-preloader">
                @if(env('APP_ENV')=="develop")
                    <!-- site construction text -->
                    <div class="maintenance-wrap fade-in" style="animation-delay: 1.5s;">
                        <div class="maintenance-anim">
                            <img src="{{ asset('public/frontend/images/construction.png') }}" alt="">
                        </div>
                        <section class="maintenance-content">
                            <h1>SITE UNDER CONSTRUCTION</h1>
                            <footer>Sorry for the inconvinience, will be back in a few days.</a>
                        </section>
                    </div>                    
                @endif
                <!-- shadow effect with logo -->
                <div class="preloader" id="page-top" class="no-scroll-y">
                    <div class="box_section">
                        <div class="image_box">
                            <img alt="image_preloader" src="{{ asset(setting('logo')) }}" class="site_logo fade-in" />
                        </div>
                        <div class="img_filter"></div>
                    </div>
                </div>

                <!-- Start: Text Loading -->
                <div class="txt-loading fade-in" style="animation-delay: 1s;">
                    @php
                    $tagline= str_split(setting('tagline'));
                    @endphp
                    @foreach($tagline as $text)
                    @if($text!=" ")
                    <span data-text-preloader="{{$text}}" class="letters-loading">{{$text}}</span>
                    @else
                    <span data-text-preloader="" class="letters-loading">&nbsp;</span>
                    @endif
                    @endforeach
                </div>
                <!-- End: Text Loading -->

            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", preloderFunction());
    
    
    
    function preloderFunction() {
      
        setTimeout(function() {
            
            // Force Main page to show from the Start(Top) even if user scroll down on preloader - Primary (Before showing content)
           
            // Model 1 - Fast            
            // document.getElementById("page-top").scrollIntoView();
            
            // Model 2 - Smooth             
            document.getElementById("page-top").scrollIntoView({behavior: 'smooth'});
                    
            
        
            
            // Removing Preloader:
            
            $('#ctn-preloader').addClass('loaded');  
            // Once the preloader has finished, the scroll appears 
            $('body').removeClass('no-scroll-y');
    
            if ($('#ctn-preloader').hasClass('loaded')) {
                // It is so that once the preloader is gone, the entire preloader section will removed
                $('#preloader').delay(350).queue(function() {
                    $(this).remove();
                    
                    // If you want to do something after removing preloader:
                    afterLoad();
                    
                });
            }
        }, 3000);
    }
    
    
    
    function afterLoad() {
        // After Load function body!
    }
</script>