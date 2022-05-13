<div wire:loading.delay>

    <div style="display: flex; justify-content: center; width: 100%; height: 100%;
     background-color: black;opacity:0.5; position: fixed; z-index: 9999;
     left: 0; top:0; align-items: center;">

        <div class="la-ball-scale la-3x">
            <div></div>
        </div>
        @push('style')
        <style>           
            .la-ball-scale,
            .la-ball-scale>div {
                position: relative;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            .la-ball-scale {
                display: block;
                font-size: 0;
                color: #fff;
            }

            .la-ball-scale.la-dark {
                color: #333;
            }

            .la-ball-scale>div {
                display: inline-block;
                float: none;
                background-color: currentColor;
                border: 0 solid currentColor;
            }

            .la-ball-scale {
                width: 32px;
                height: 32px;
            }

            .la-ball-scale>div {
                width: 32px;
                height: 32px;
                border-radius: 100%;
                opacity: 0;
                -webkit-animation: ball-scale 1s 0s ease-in-out infinite;
                -moz-animation: ball-scale 1s 0s ease-in-out infinite;
                -o-animation: ball-scale 1s 0s ease-in-out infinite;
                animation: ball-scale 1s 0s ease-in-out infinite;
            }

            .la-ball-scale.la-sm {
                width: 16px;
                height: 16px;
            }

            .la-ball-scale.la-sm>div {
                width: 16px;
                height: 16px;
            }

            .la-ball-scale.la-2x {
                width: 64px;
                height: 64px;
            }

            .la-ball-scale.la-2x>div {
                width: 64px;
                height: 64px;
            }

            .la-ball-scale.la-3x {
                width: 96px;
                height: 96px;
            }

            .la-ball-scale.la-3x>div {
                width: 96px;
                height: 96px;
            }

            
            @-webkit-keyframes ball-scale {
                0% {
                    opacity: 1;
                    -webkit-transform: scale(0);
                    transform: scale(0);
                }

                100% {
                    opacity: 0;
                    -webkit-transform: scale(1);
                    transform: scale(1);
                }
            }

            @-moz-keyframes ball-scale {
                0% {
                    opacity: 1;
                    -moz-transform: scale(0);
                    transform: scale(0);
                }

                100% {
                    opacity: 0;
                    -moz-transform: scale(1);
                    transform: scale(1);
                }
            }

            @-o-keyframes ball-scale {
                0% {
                    opacity: 1;
                    -o-transform: scale(0);
                    transform: scale(0);
                }

                100% {
                    opacity: 0;
                    -o-transform: scale(1);
                    transform: scale(1);
                }
            }

            @keyframes ball-scale {
                0% {
                    opacity: 1;
                    -webkit-transform: scale(0);
                    -moz-transform: scale(0);
                    -o-transform: scale(0);
                    transform: scale(0);
                }

                100% {
                    opacity: 0;
                    -webkit-transform: scale(1);
                    -moz-transform: scale(1);
                    -o-transform: scale(1);
                    transform: scale(1);
                }
            }
        </style>
        @endpush
    </div>
</div>