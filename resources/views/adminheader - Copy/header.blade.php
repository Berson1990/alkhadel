<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Alexandria 4 Programming ERP-Systems</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content="{{csrf_token()}}" name ="_token">
    <!-- Bootstrap 3.3.2 -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/bootstrap-dialog/bootstrap-dialog.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.1.3 -->
    <link href="{{ asset('sales/css/chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jQueryUI/jquery-ui.min.css') }}" rel="stylesheet">
    <style type="text/css">

          /*.chosen-rtl .chosen-drop { left: -10000px; }*/

    </style>
    <script src="/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="{{asset('sales/js/table_keypress.js')}}"></script>
</head>
<body class="skin-blue">



    
<div class="wrapper">

    <header class="main-header">
        <a href="#" class="logo"><b>Alex</b> 4 Programming</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
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
                            <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                            <span class="hidden-xs">Moustafa Gouda</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                                <p>
                                    Moustafa - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="/auth/logout" class="btn btn-flat btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>الصفحــة الرئيسية</span></i>
                    </a>
                </li>
                <li class="treeview active">
                    <a href="javascript:void(0)">
                        <i class="fa fa-tags"></i>
                        <span>البيانات الأساسية</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active" ><a href="/product"> <i class="fa fa-circle-o"> </i> &nbsp; الأصنـــاف</a></li>
                        <li ><a href="/customer"><i class="fa fa-circle-o"></i> " العمــلاء " التجــار </a></li>
                        <li ><a href="/supplier"><i class="fa fa-circle-o"></i>" الموردين " الفلاحين </a></li>
                        <li ><a href="/employee"><i class="fa fa-circle-o"></i> الموظفين</a></li>
                        <li ><a href="/custom"><i class="fa fa-circle-o"></i> المستخلصين</a></li>
                        <li ><a href="/cashier"><i class="fa fa-circle-o"></i> الخــزن</a></li>
                        <li ><a href="/bank"><i class="fa fa-circle-o"></i> البنــوك</a></li>
                        <li ><a href="/driver"><i class="fa fa-circle-o"></i> السائقين</a></li>
                        <li ><a href="/currency"><i class="fa fa-circle-o"></i> العمــلات</a></li>
                        <li ><a href="/carrying"><i class="fa fa-circle-o"></i> المشال</a></li>
                        <li ><a href="/stockholder"><i class="fa fa-circle-o"></i> المــلاك</a></li>
                    </ul>
                </li>
                <li class="treeview active">
                    <a href="javascript:void(0)">
                        <i class="fa fa-tags"></i>
                        <span>الحسابات</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active" ><a href="/expensestypes">&nbsp;<i class="fa fa-circle-o"></i>أنواع المصروفات</a></li>
                        <li ><a href="/expense"><i class="fa fa-circle-o"></i> المصروفات </a></li>
                        <li ><a href="/customersdiscount"><i class="fa fa-circle-o"></i> الخصم المسموح به </a></li>
                        <li ><a href="/suppliersdiscount"><i class="fa fa-circle-o"></i> الخصم المكتسب به </a></li>
                        <li ><a href="/cashieropeningbalance"><i class="fa fa-circle-o"></i>رصيد افتتاحى للخزن</a></li>
                        <li ><a href="/cashiertransfer"><i class="fa fa-circle-o"></i>تحويل من خزنة لخزنة</a></li>
                        <li ><a href="/cashierbanktransfer"><i class="fa fa-circle-o"></i>تحويل من خزنة لبنك</a></li>
                        <li ><a href="/cashdeposit"><i class="fa fa-circle-o"></i>المقبوضات النقدية</a></li>
                        <li ><a href="/cashpayemnt"><i class="fa fa-circle-o"></i>المدفوعات النقدية</a></li>
                        <li ><a href="/bankopeningbalance"><i class="fa fa-circle-o"></i>رصيد إفتتاحى لبنك</a></li>
                        <li ><a href="/bankcashiertransfer"><i class="fa fa-circle-o"></i>تحويل من بنك لخزنة</a></li>
                        <li ><a href="/addnotice"><i class="fa fa-circle-o"></i>تسجيل إشعارات الإضافة</a></li>
                        <li ><a href="/discountnotice"><i class="fa fa-circle-o"></i>تسجيل إشعارات الخصم</a></li>
                        <li ><a href="/checkdeposit"><i class="fa fa-circle-o"></i>مدفوعات العملاء شيكات</a></li>
                        <li ><a href="/checkpayment"><i class="fa fa-circle-o"></i>المدفوعات شيكات</a></li>
                        <li ><a href="/holderdrawal"><i class="fa fa-circle-o"></i>تسجيل المسحوبات الملاك</a></li>
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
    <script src="/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js" type="text/javascript"></script>
    <script src="/plugins/bootstrap-dialog/bootstrap-dialog.js" type="text/javascript"></script>
    <script src="{{asset('plugins/jQueryUI/jquery-ui-1.11.4.min.js')}}"></script>
    
    <!-- page script -->
    <script type="text/javascript">
        $(function () {
            $('#example2').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
            change_layout("sidebar-collapse");
        });
    </script>

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
