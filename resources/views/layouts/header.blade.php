<head>
    <title>{{ $title ?? 'TGCC' }}</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="Tritih Golf & Country Club" />
    <meta name="author" content="inovis" />
    <meta name="keywords" content="tgcc" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#6777ef" />
    <link rel="icon" href="{{ asset('tgcc144.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('tgcc144.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link rel="icon" href="{{ asset('tgcc144.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dist/asset_offline/css/introjs.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.min.css') }}">
    @stack('css')
    <script>
        function setCookie(cname,cvalue,exdays) {
            var d = new Date();
            d.setTime(d.getTime()+(exdays*24*60*60*1000));
            var expires = "expires="+d.toGMTString();
            document.cookie = cname + "=" + cvalue + ";path=/;" + expires;
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i=0; i<ca.length; i++) {
                var c = ca[i].trim();
                if (c.indexOf(name)==0) return c.substring(name.length,c.length);
            }
            return "";
        } 

        if (getCookie('dismissed') != '1') {
            var html_node = document.getElementsByTagName('html')[0];
            var div = document.createElement('div');
            div.setAttribute('id', 'slow-notice');
            var slowLoad = window.setTimeout( function() {
                var t1 = document.createTextNode("Jaringan anda sangat lambat");
                var dismiss = document.createElement('span');
                dismiss.innerHTML = '[x] dismiss';
                dismiss.setAttribute('class', 'dismiss');
                dismiss.onclick = function() {
                    setCookie('dismissed', '1', 1);
                    html_node.removeChild(div);
                }
                var dismiss_container = document.createElement('div');
                dismiss_container.appendChild(dismiss);
                dismiss_container.setAttribute('class', 'dismiss-container');
                div.appendChild(t1);
                div.appendChild(dismiss_container);
                html_node.appendChild(div);
            }, 1000 );
            window.addEventListener( 'load', function() {
                try {
                    window.clearTimeout( slowLoad );
                    html_node.removeChild(div);
                } catch (e){
                    // that's okay.
                }
            });
        }
    </script>
</head>