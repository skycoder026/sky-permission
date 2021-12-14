



<!DOCTYPE html>


<html lang="en">


    <head>

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />


        <!-- TITLE -->
        <title>@yield('title') - Free Wire</title>


        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


        <!-- FAB ICON -->
        <link rel="icon" href="icon.png" type="image/png">



        <!-- csrf token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />


        <!-- font & font awesome -->
        <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}?v=0.1" />





        <!-- stack & yield  css -->
        @yield('css')

        @stack('style')




        <!-- ace styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />




        <!-- ace settings handler -->
        <script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>



        <!-- sweat alert -->
        <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}" />




        <!-- toster -->
        <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}" />


        <!-- custom css for master page -->
        <link rel="stylesheet" href="{{ asset('assets/custom-css/master.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/custom-css/color-size.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/custom-css/bootstrap4.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/custom-css/bootstrap4.css') }}" />

    </head>



    <body class="no-skin" style="font-family: monospace;">

        <!-- headeer -->
        @include('sky-permission::partials._header')






        <div class="main-container ace-save-state" id="main-container">



            <!-- SIDEBAR -->
            @include('sky-permission::partials._sidebar')





                <div class="main-content">

                    @if (request()->is('/') || request()->is('home')))

                        <div class="main-content-inner" style="background: #f2f2f2">

                        <div class="page-content" style="background: transparent; padding-bottom: 0;">

                    @else
                        <div class="main-content-inner">

                        <div class="page-content">

                    @endif





                    <!-- DYNAIC CONTENT FROM VIEWS -->
                    @yield('content', 'Default Content')

                </div>
            </div>
        </div>




        <!-- FOOTER -->
        @include('sky-permission::partials._footer')




        <!-- delete form -->
        <form action="" id="deleteItemForm" method="POST">
            @csrf @method("DELETE")
        </form>

    </div>


    <script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.query-object.js') }}"></script>


    <![endif]-->
    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('assets/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
    </script>


    <!-- ace scripts -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>




    <!-- toster -->
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <!-- custom toster -->
    <script src="{{ asset('assets/custom-js/message-display.js') }}"></script>



    <script type="text/javascript">
        function withDefault(value, default_value) {
            return value ? value : default_value
        }
    </script>




    <script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
    <script src="{{ asset('assets/js/ace.min.js') }}"></script>

    <script src="{{ asset('assets/custom-js/confirm_delete_dialog.js') }}"></script>

    <!-- js yield -->
    @yield('js')

    @yield('script')





    <script type="text/javascript">

        $('[data-rel=popover]').popover({html:true, container:'body'});


        $('.success').fadeIn('slow').delay(10000).fadeOut('slow');

        $('.bs-tooltip').tooltip()

    </script>


    <script type="text/javascript">

        function showAlertMessage(message, time = 1000, type = 'error')
        {
            swal.fire({
                title: type.toUpperCase(),
                html: "<b>" + message + "</b>",
                type: type,
                timer: time
            })
        }


        @if(session()->get('message'))
            swal.fire({
                title: "Success",
                html: "<b>{{ session()->get('message') }}</b>",
                type: "success",
                timer: 1000
            });


        @elseif(session()->get('error'))
            swal.fire({
                title: "Error",
                html: "<b>{{ session()->get('error') }}</b>",
                type: "error",
                timer: 1000
            });
        @endif




        function onlyNumber(evnt)
        {
            let keyCode = evnt.charCode

            let str = evnt.target.value
            let n = str.includes(".")

            if (keyCode == 13) {
                evnt.preventDefault();
            }

            if (keyCode == 46 && n) {
                return false
            }

            if (str.length > 12) {
                showAlertMessage('Number length out of range', 3000)

                return false
            }
            return (keyCode >= 48 && keyCode <= 57) || keyCode == 13 || keyCode == 46
        }


        $(document).on('keypress', '.only-number', function() {
            return onlyNumber(event)
        })

    </script>


    <script>
        let path = window.location.href

        path = path.replace('#', '')

        let selector = "a[href='" + path + "']"

        if (!$(selector).closest('li').hasClass('hasQuery')) {
            path = path.split('?')[0]
            selector = "a[href='" + path + "']"
        }

        if ($(selector).length < 1) {

            selector = selector.substring(0, selector.lastIndexOf('/'))

            if ($(selector).length < 1) {

                selector = selector.substring(0, selector.lastIndexOf('/'))
            }
        }


        let a_tag = $(selector)



        let li_tag = a_tag.closest('li')

        li_tag.addClass('active')

        li_tag.parents('li').add(this).each(function() {

            $(this).addClass('open')

        });
    </script>


</body>
</html>
