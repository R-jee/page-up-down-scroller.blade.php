<style>
    .blok:nth-of-type(odd) {
        background-color:white;
    }
    .blok:nth-of-type(even) {
        background-color:black;
    }
    @-webkit-keyframes border-transform{
        0%,100% { border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%; }
        14% { border-radius: 40% 60% 54% 46% / 49% 60% 40% 51%; }
        28% { border-radius: 54% 46% 38% 62% / 49% 70% 30% 51%; }
        42% { border-radius: 61% 39% 55% 45% / 61% 38% 62% 39%; }
        56% { border-radius: 61% 39% 67% 33% / 70% 50% 50% 30%; }
        70% { border-radius: 50% 50% 34% 66% / 56% 68% 32% 44%; }
        84% { border-radius: 46% 54% 50% 50% / 35% 61% 39% 65%; }
    }

    /* #Progress ================================================== */
    .progress-wrap {
        background-color: #f4f4f4;
        position: fixed;
        right: 30px;
        bottom: 30px;
        height: 46px;
        width: 46px;
        cursor: pointer;
        display: block;
        border-radius: 60px;
        box-shadow: inset  0 0 0 2px rgba(0,0,0,0.1);
        box-shadow: 0px 0px 10px 2px rgba(0,0,0,0.1);
        z-index: 1001;
        opacity: 0;
        visibility: hidden;
        transform: translateY(15px);
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }

    .progress-wrap.active-progress {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .progress-wrap::after {
        position: absolute;
        font-family: 'unicons';
        content: url("{{asset('images/logo/topButton.svg')}}");
        text-align: center;
        line-height: 46px;
        font-size: 24px;
        color: rgba(0, 0, 0, 0.3); /* --- Pijl kleur --- */
        top: 4px;
        right: 12px;
        height: 24px;
        width: 24px;
        cursor: pointer;
        display: block;
        z-index: 1;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }
    .progress-wrap:hover::after {
        opacity: 0;
    }
    .progress-wrap::before {
        position: absolute;
        font-family: 'unicons';
        content: url("{{asset('images/logo/topButton.svg')}}");
        text-align: center;
        line-height: 46px;
        font-size: 24px;
        opacity: 0;
        background: black; /* --- Pijl hover kleur --- */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        top: 4px;
        right: 12px;
        height: 24px;
        width: 24px;
        cursor: pointer;
        display: block;
        z-index: 2;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }
    .progress-wrap:hover::before {
        opacity: 1;
    }
    .progress-wrap svg path {
        fill: none;
    }
    .progress-wrap svg.progress-circle path {
        stroke: rgba(0, 0, 0, 0.2); /* --- Lijn progres kleur --- */
        stroke-width: 4;
        box-sizing:border-box;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
    }
</style>

<div class="paginacontainer">
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
    </div>
</div>

@push('scripts')
    <script>
        (function($) { "use strict";
            $(document).ready(function(){"use strict";
                var progressPath = document.querySelector('.progress-wrap path');
                var pathLength = progressPath.getTotalLength();
                progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
                progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
                progressPath.style.strokeDashoffset = pathLength;
                progressPath.getBoundingClientRect();
                progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
                var updateProgress = function () {
                    var scroll = $(window).scrollTop();
                    var height = $(document).height() - $(window).height();
                    var progress = pathLength - (scroll * pathLength / height);
                    progressPath.style.strokeDashoffset = progress;
                }
                updateProgress();
                $(window).scroll(updateProgress);
                var offset = 50;
                var duration = 0;
                jQuery(window).on('scroll', function() {
                    if (jQuery(this).scrollTop() > offset) {
                        jQuery('.progress-wrap').addClass('active-progress');
                    } else {
                        jQuery('.progress-wrap').removeClass('active-progress');
                    }
                });
                jQuery('.progress-wrap').on('click', function(event) {
                    event.preventDefault();
                    jQuery('html, body').animate({scrollTop: 0}, duration);
                    return false;
                })
            });
        })(jQuery);

    </script>
@endpush
