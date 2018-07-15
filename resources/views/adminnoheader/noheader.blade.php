<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alexandria 4 Programming ERP-Systems</title>
    <link href={{asset('sales/css/chosen.css')}} rel="stylesheet">
    <link href={{asset('plugins/jQueryUI/jquery-ui.min.css')}} rel="stylesheet">
<!--    <script src={{asset("/plugins/jQuery/jQuery-2.1.3.min.js")}}></script>-->
    
<!--
    <style type="text/css">

          .chosen-rtl .chosen-drop { left: -10000px; }

    </style>
-->
    
</head>
<body class="skin-blue">
    <div class="wrapper">


        <!-- Content Wrapper. Contains page content -->
        <div class="" style="background-color : #ecf0f5;" >
            <!-- Content Header (Page header) -->
            
            @yield('header')

            @yield('content')

        </div><!-- /.content-wrapper -->
            <!--
                  <footer class="main-footer">
                    <div class="pull-right hidden-xs">
                      <b>Version</b> 2.0
                    </div>
                    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
                  </footer>
            -->
    </div><!-- ./wrapper -->


<!--    <script src="/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>-->
<!--    <script src="/dist/js/app.min.js" type="text/javascript"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('plugins/jQueryUI/jquery-ui-1.11.4.min.js')}}"></script>
 
    <script src="{{asset('sales/js/chosen.jquery.js')}}"></script>
        <script type="text/javascript">

            var _gridview_ctrid = 'tbl_view';
            var _gridview_firstcolnum = 2;
            var _gridview_isAddRow = false;
            $(document).ready(function() {
//                reloadcbo();
            });
            function reloadcbo ()
            {
                var config = {
                    '.chosen-select'           : {allow_single_deselect:true},
                    '.chosen-select-deselect'  : {allow_single_deselect:true},
                    '.chosen-select-no-single' : {disable_search_threshold:10},
                    '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                    '.chosen-select-width'     : {width:"100%"}
                }
                var count = 0 ;
                for (var selector in config)
                {
                    $(selector).chosen(config[selector]).change( function(e,data){
                        var cbo = $(this);
                        var row = $(this).closest('tr');
                        
                        //cbo_chnage(this)
                    } );
                }
            }

            $( document ).ready(function() 
                {
                
                    $('body').on('keypress keyup blur','.only_float ,.only_num' , function(event){

                        var code = event.keyCode;
                        var type = event.type;


                        // console.log('*********************************');
                        // console.log('type : ' + type);
                        // console.log('code : ' + code);

                        // //
                        // console.log('which : ' + event.which);
                        // console.log('##################################');

                        // console.log('return000');
                        if (code == 8 || code == 37 || code == 39) // backspace - left - right
                        {
                            return;
                        }
                        
                        if ($(this).hasClass('only_num'))
                        {
                            $(this).val($(this).val().replace(/[^\d].+/, ""));
                            if ((event.which < 48 || event.which > 57)) 
                            {
                                event.preventDefault();
                            }
                        }
                        else // only_float
                        {
                            $(this).val($(this).val().replace(/[^0-9\.]/g,''));
                            if ((event.which == 46 && $(this).val().indexOf('.') > -1) && (event.which < 48 || event.which > 57)) 
                            {
                                event.preventDefault();
                            }
                        }
                       

                    });

            });

        </script>

        @yield('footer_script')


</body>
</html>
