<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="{{csrf_token()}}" name ="_token">
    <title>Alex For Programming</title>

    <link href="{{ asset('sales/css/app.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('sales/css/chosen.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('plugins/jQueryUI/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <style type="text/css" media="all">
        /* fix rtl for demo */
        /*.chosen-rtl .chosen-drop { left: -9000px; }*/
        .hidden_a4p
        {
            display: none;
        }

        #tbl_view tr:not(:first-child) td:nth-child(2):before
        {
            counter-increment: Serial;      /* Increment the Serial counter */
            /*content: "Serial is: " counter(Serial); /* Display the counter */
            content: counter(Serial); /* Display the counter */
        }


        #tbl-salesdetails thead tr td:nth-child(1), #tbl-salesdetails tbody tr td:nth-child(1)
        {
            background-color:#143e66 ;
        }
        .widedrop{
            width: 460px !important;
        }
        
        .navbar {
          background:#31b0d5;
            
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{asset('sales/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('sales/js/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body>
{{--<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header ">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:void(0)">Alex For Programming</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="javascript:void(0)">Home</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="javascript:void(0)">Login</a></li>
                    <li><a href="javascript:void(0)">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0)">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>--}}
<div class="navbar form-control btn-primary">
    <h4 id="enddellsales" class="col-xs-6"><a  href="{{url('/sales/endoutdeal')}}">  اغلاق الفواتير المعلقة</a></h4>
    <h4 class="col-xs-6"><a href="{{ URL('customerscp')  }}"> شــاشه العملاء </a></h4>
</div>
@yield('content')

<!-- Scripts -->
<script src="{{asset('plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-dialog/bootstrap-dialog.js')}}"></script>
<script src="{{asset('plugins/jQueryUI/jquery-ui-1.11.4.min.js')}}"></script>
<!--<script src="{{asset('plugins/datepicker/locales/bootstrap-datepicker.ar.js')}}"></script>-->
{{--<script src="{{asset('sales/js/chosen.jquery.js')}}"></script>--}}
<script src="{{asset('sales/js/table_keypress.js')}}"></script>

@yield('jscript')

<script type="text/javascript">

    var _gridview_ctrid = 'tbl_view';
    var _gridview_firstcolnum = 2;
    var _gridview_isAddRow = false;
    $(document).ready(function() {
        /*reloadcbo();*/
    });
//    function reloadcbo ()
//    {
//
//        var config = {
//            '.chosen-select'           : {allow_single_deselect:true},
//            '.chosen-select-deselect'  : {allow_single_deselect:true},
//            '.chosen-select-no-single' : {disable_search_threshold:10},
//            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
//            '.chosen-select-width'     : {width:"100%"}
//        }
//        var count = 0 ;
//        for (var selector in config)
//        {
//            $(selector).chosen(config[selector]).change( function(e,data){
//                var cbo = $(this);
//                var row = $(this).closest('tr');
//                if( $(cbo).closest('tr').next().length == 0 && $(cbo).val() > 0  && $(cbo).parent().is('div') == false )
//                {
//                    if (_gridview_isAddRow == true)
//                    {
////                                    _gridview.addrow();
//                    }
//                }
//            } );
//        }
//    }

    function isNumberKey(evt){
        /*var charCode = (evt.which) ? evt.which : 0
        if (charCode > 31 && (charCode < 48 || charCode > 57 ) && charCode != 45)
            return false;
        return true;*/
    }

    $(function() {
        $( "#datepicker ,[name=up_SalesDate]" ).datepicker({
            dateFormat: 'yy/mm/dd',
            currentText: "Today:" + $.datepicker.formatDate('yy/mm/dd', new Date()),
//             locale: 'ar',
        });
        
        $( "#datepicker" ).datepicker("setDate", new Date());
        @if(isset($Sales->SalesDate))
        $('[name=SalesDate]').val( "{{$Sales->SalesDate}}" );
        @endif

    });
    
        $(function () {
                $('#datepicke').datetimepicker({
                    locale: 'ar'
                });
            });

    $(function() { // Error box

        //Close alert
        $('#error-box  .close, #uperror-box .close , #upconfirmBox .close , .closebox').click(function(e) {
            e.preventDefault();
            $(this).closest('div').slideUp(function(){
                $('#confirmYES').removeAttr('data-flag');
            });

        });

    });
//     
//$(document).ready(function() { 
//           
//("#enddellsales").css("display","none");  
////    ("#enddellsales").hide();
////$("#CustomerID").onchange                  
//                  
//});

//    ("#enddellsales").hide(); 
</script>
</body>
</html>
