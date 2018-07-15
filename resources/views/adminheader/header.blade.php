<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alexandria 4 Programming ERP-Systems</title>
<!--    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>-->
<!--    <meta content="{{csrf_token()}}" name ="_token">-->
    <!-- Bootstrap 3.3.2 -->
    <link href={{asset('bootstrap/css/bootstrap.min.css')}} rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!--  test table tools min.css  -->
<!--    <link  href="//cdn.datatables.net/tabletools/2.2.1/css/dataTables.tableTools.min.css" rel="stylesheet"-->
<!--type="text/css" />    -->
<!--<link  href={{asset("plugins/datatables/dataTables.tableTools.min.css" )}} rel="stylesheet" type="text/css" />-->
    <!-- DataTables CSS -->
<!--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">-->


    <!-- DATA TABLES -->
    <link href={{asset('plugins/datatables/dataTables.bootstrap.css') }} rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href={{asset('dist/css/AdminLTE.min.css')}} rel="stylesheet" type="text/css" />
    <link href={{asset('plugins/bootstrap-dialog/bootstrap-dialog.css')}} rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href={{asset('dist/css/skins/_all-skins.min.css')}} rel="stylesheet" type="text/css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.1.3 -->
    <link href={{asset('/sales/css/chosen.css') }} rel="stylesheet">
    <link href={{asset('/plugins/jQueryUI/jquery-ui.min.css')}} rel="stylesheet">
<!--    <link href={{asset('/plugins/jQueryUI/jquery-ui.min.css')}} rel="stylesheet">-->
    <link href={{asset('/plugins/tabpages/tabpages.css')}} rel="stylesheet">
    <style type="text/css">

          .chosen-rtl .chosen-drop { left: -10000px; }

    </style>
    <script src={{asset('plugins/jQuery/jQuery-2.1.3.min.js')}}></script>
<!--    <script src={{asset('plugins/datepicker/arabic.js')}}></script>-->

<!--    <script src="/plugins/jQuery-Arabic-Datepicker/jquery.datepick-ar.js"></script>-->
    <script src={{asset('sales/js/table_keypress.js')}}></script>
    <link href={{asset('dist/css/skins/hover.css')}} rel="stylesheet" type="text/css" /><style>


     .skin-blue .treeview-menu>li>a:hover  {
/*                 color: #f90;*/
                }

/*          .treeview .treeview-menu .hoverlink{color:#f90;}*/



          .chosen-rtl .chosen-drop { left: -10000px; }

    </style>


</head>
<body class="skin-blue">




<div class="wrapper">

    <header class="main-header">
        <a href="#" class="logo"><b></b> </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav  class="navbar navbar-static-top" role="navigation">
            <!-- href="#" Sidebar toggle button  sidebar-toggle-->
            <a  class="" data-toggle="offcanvas" role="">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- Notifications: style can be found in dropdown.less -->
                    <!-- Tasks: style can be found in dropdown.less -->
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
<!--                            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"/>-->
<!--                            <span class="hidden-xs">Moustafa Gouda</span>-->
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
<!--
                            <li class="user-header">
                                <img src="{{ asset ('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                                <p>
                                    Moustafa - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
-->
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{asset ('auth/logout')}}" class="btn btn-flat btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside  class="main-sidebar" dir="rtl">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul   class="sidebar-menu">
<!--
                <li class="treeview">
                    <a href="{{ URL('/home') }}">
                        <i class="fa fa-dashboard"></i> <span class="sub-title">الصفحــة الرئيسية</span></i>
                    </a>
                </li>

-->
                <li class="treeview active">
                    <a href="javascript:void(0)">
                        <i class="fa fa-tags"></i>
                        <span class="sub-title">البيانات الأساسية</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" >
                        <li class="active" ><a href="{{ URL('/home') }}"><i class="fa fa-circle-o"></i>&nbsp;شاشة البيع</a></li>
						<li class="" ><a id="link00" href="{{ URL ('/product')}}"><i class="fa fa-circle-o"></i> &nbsp;الأصنـــاف</a></li>
                        <li ><a id="link01"  href="{{URL ('/customer') }}"><i class="fa fa-circle-o"></i> &nbsp;"العمــلاء " التجــار </a></li>
                        <li ><a id="link02"  href="{{ URL ('/supplier')}}"><i class="fa fa-circle-o"></i>&nbsp;"الموردين " الفلاحين </a></li>
                        <li ><a id="link03"  href="{{URL ('/employee')}}"><i class="fa fa-circle-o"></i>&nbsp;الموظفين</a></li>
                        <li ><a id="link04"  href="{{ URL ('/custom')}}"><i class="fa fa-circle-o"></i>&nbsp;المستخلصين</a></li>
                        <li ><a id="link05"  href="{{ URL ('/cashier')}}"><i class="fa fa-circle-o"></i>&nbsp;الخــزن</a></li>
                                                <li ><a id="link08"  href="{{ URL ('/currency')}}"><i class="fa fa-circle-o"></i>&nbsp;العمــلات</a></li>
                        <li ><a id="link06"  href="{{ URL ('/banks')}}"><i class="fa fa-circle-o"></i>&nbsp;البنــوك</a></li>
                        <li ><a id="link07"  href="{{ URL ('/driver')}}"><i class="fa fa-circle-o"></i>&nbsp;السائقين</a></li>

                        <li ><a href="{{ URL ('/carrying') }}"><i class="fa fa-circle-o"></i>المشال</a></li>
                        <li ><a id="link09"  href="{{ URL ('/stockholder')}}"><i class="fa fa-circle-o"></i>&nbsp;المــلاك</a></li>
						<li ><a id="link10"  href="{{ URL ('/container')}}"><i class="fa fa-circle-o"></i>&nbsp;الحاويات</a></li>
<!--                        <li ><a href="{{ URL ('/expensesgroup')}}"><i class="fa fa-circle-o"></i>مجموعات المصروفات</a></li>-->
                    </ul>
                </li>
                <li class="treeview active">
                    <a href="javascript:void(0)">
                        <i class="fa fa-tags"></i>
                        <span class="sub-title">الحسابات</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li ><a id="link11"  href="{{ url ('/expensescp')}}"><i class="fa fa-circle-o"></i> &nbsp;المصروفات </a></li>
                        <li ><a id="link12"  href="{{ url ('/customerscp')}}"><i class="fa fa-circle-o"></i> &nbsp;حسابات العملاء </a></li>
                        <li ><a id="link13"  href="{{ url ('/supplierscp') }}"><i class="fa fa-circle-o"></i> &nbsp;حسابات الموردين </a></li>
                        <li ><a id="link26"  href="{{ url ('/customecp') }}"><i class="fa fa-circle-o"></i> &nbsp;حسابات المستخلصين </a></li>
                        <li ><a id="link14"  href="{{ url ('/cashieropeningbalance')}}"><i class="fa fa-circle-o"></i>&nbsp;رصيد افتتاحى للخزن</a></li>
                        <li ><a id="link15"  href="{{ url ('/cashiertransfer')}}"><i class="fa fa-circle-o"></i>&nbsp;تحويل من خزنة لخزنة</a></li>
                        <li ><a id="link16"  href="{{ url ('/cashierbanktransfer')}}"><i class="fa fa-circle-o"></i>&nbsp;تحويل من خزنة لبنك</a></li>
                        <li ><a id="link17"  href="{{ url ('/bankopeningbalance')}}"><i class="fa fa-circle-o"></i>&nbsp;رصيد إفتتاحى لبنك</a></li>
                        <li ><a id="link18"  href="{{ url ('/bankcashiertransfer')}}"><i class="fa fa-circle-o"></i>&nbsp;تحويل من بنك لخزنة</a></li>
                        <li ><a id="link19"  href="{{ url ('/addnotice')}}"><i class="fa fa-circle-o"></i>&nbsp;تسجيل إشعارات الإضافة</a></li>
                        <li ><a id="link20"  href="{{ url ('/discountnotice')}}"><i class="fa fa-circle-o"></i>&nbsp;تسجيل إشعارات الخصم</a></li>
                        <li ><a id="link21"  href="{{ url ('/holderdrawal')}}"><i class="fa fa-circle-o"></i>&nbsp;تسجيل المسحوبات الملاك</a></li>
                    </ul>
                </li>

		  <li class="treeview active">
                    <a href="javascript:void(0)">
                        <i class="fa fa-tags"></i>
                        <span class="sub-title">التقارير </span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                       <li  ><a id="link27"   href="{{ url('/dailyreport')}}"><i class="fa fa-circle-o"></i> &nbsp;التقارير اليوميه  </a></li>
                        <li  ><a id="link28"   href="{{ url ('/productscard')}}"><i class="fa fa-circle-o"></i> &nbsp;كارتة الصنف   </a></li>
                        <li  ><a id="link29"   href="{{ url ('/settlementcashier')}}"><i class=" fa fa-circle-o"></i>&nbsp; كشف حساب الخزن </a></li>
                        <li  ><a id="link30"   href="{{ url ('/dailycashier')}}"><i class=" fa fa-circle-o"></i>&nbsp; تقرير يوميه الخزن  </a></li>
                        <li  ><a id="link31"   href="{{ url ('/settlementbank')}}"><i class=" fa fa-circle-o"></i>&nbsp; كشف حساب بنك </a></li>
                        <li  ><a id="link32"   href="{{ url ('/carryingreprot')}}"><i class=" fa fa-circle-o"></i>&nbsp;  تقرير المشال  </a></li>
                        <li  ><a id="link33"   href="{{ url ('/customersbills')}}"><i class=" fa fa-circle-o"></i>&nbsp;   كشف حساب تجار </a></li>
                         <li  ><a id="link34"  href="{{ url ('/abordcustomerbills')}}"><i class=" fa fa-circle-o"></i>&nbsp;  كشف حساب تاجر سفر  </a></li>
                        <li  ><a id="link35"   href="{{ url ('/supplierbills')}}"><i class=" fa fa-circle-o"></i>&nbsp;  كشف حساب مورد محلى </a></li>
                        <li  ><a id="link36"   href="{{ url ('/foreignsuppliersstatment')}}"><i class=" fa fa-circle-o"></i>&nbsp;  كشف حساب مورد خارجى </a></li>
                         <li  ><a id="link37"  href="{{ url ('/customsreport')}}"><i class=" fa fa-circle-o"></i>&nbsp;  كشف حساب المستخلصين  </a></li>
                        <li  ><a id="link22"  href="{{ url ('/totallocalcustomers')}}"><i class=" fa fa-circle-o"></i>&nbsp;   تقرير اجمالى المبيعات -محلى   </a></li>
                        <li  ><a id="link23"  href="{{ url ('/totaltravelcustomers')}}"><i class=" fa fa-circle-o"></i>&nbsp;      تقرير اجمالى المبيعات -سفر  </a></li>
                        <li  ><a id="link24"  href="{{ url ('/localsupplerstotalcommition')}}"><i class=" fa fa-circle-o"></i>&nbsp;    اجمالى عموله الموردين المحليين </a></li>
                        <li  ><a id="link25"  href="{{ url ('/forignsupplerstotalcommition')}}"><i class=" fa fa-circle-o"></i>&nbsp;      اجمالى عموله الموردين الخارجيين </a></li>
                        <li  ><a id="link26"  href="{{ url ('/localsupplerstotalqlmia')}}"><i class=" fa fa-circle-o"></i>&nbsp;   اجمالى قلميه الموردين المحليين   </a></li>



                    </ul>
                </li>
        </section>
        <!-- /.sidebar -->
    </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
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


    <!-- Bootstrap 3.3.2 JS -->
    <script src={{asset('/bootstrap/js/bootstrap.min.js')}} type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
     <script src={{asset('/plugins/datatables/dataTables.bootstrap.js')}} type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src={{asset('/plugins/slimScroll/jquery.slimscroll.min.js')}} type="text/javascript"></script>
    <!-- FastClick -->
<!--    <script src={{asset('plugins/fastclick/fastclick.min.js')}}></script>-->
    <!-- AdminLTE App -->
    <script src={{asset('dist/js/app.min.js')}} type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src={{asset('dist/js/demo.js')}} type="text/javascript"></script>
    <script src={{asset('plugins/bootstrap-dialog/bootstrap-dialog.js')}} type="text/javascript"></script>
    <script src={{asset('plugins/jQueryUI/jquery-ui-1.11.4.min.js')}}></script>
    <!-- <script src={{asset("/plugins/datatables/jquery.dataTables2.min.js")}} type="text/javascript"></script> -->
    <script src={{asset("/plugins/datatables/jquery.dataTables.js")}} type="text/javascript"></script>
    <script src={{asset("//cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js")}} type="text/javascript"></script>
    <!-- <script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script> -->
    <script src={{asset("//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf")}} type="text/javascript"></script>
    <!-- <script src={{asset("/plugins/datatables/buttons.flash.min.js")}} type="text/javascript"></script> -->
    <!-- <script type="text/javascript src={http://datatables.net/release-datatables/extras/TableTools/media/swf/copy_csv_x‌​ls_pdf.swf.}}></script> -->

    <!-- page script -->
    <script type="text/javascript">
        $(function () {
            $('#example2').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": true,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
            //change_layout("sidebar-collapse");
        });
    </script>

    <script src="{{asset('sales/js/chosen.jquery.js')}}"></script>
        <script type="text/javascript">

            var _gridview_ctrid = 'tbl_view';
            var _gridview_firstcolnum = 2;
            var _gridview_isAddRow = false;
            $(document).ready(function() {
                reloadcbo();
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

            $(document).ready(function()
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




<script>

  $(document).ready(function() {

       $("br").removeClass("hide");

      $(".treeview-menu li a").on("click", function(){

      $(this).addClass("hoverlink");

});

  });
//

//
//    $(document).ready(function() {
//    $('a').click(function() {
//        a = $(this).attr('href'); //grab #one, #two which correspond to the div id we're targetting
//        paragraph = $(a); //store each div in a variable for later use
//
//        if(paragraph.hasClass('grey-bg')) {
//            $(paragraph).removeClass('grey-bg');
//        } else {
//            $('a').removeClass('grey-bg'); //remove any greyed backgrounds
//            $(paragraph).addClass('grey-bg'); //add grey background to clicked element
//        }
//
//    });
//});
//
 </script>



        @yield('footer_script')


</body>
</html>
