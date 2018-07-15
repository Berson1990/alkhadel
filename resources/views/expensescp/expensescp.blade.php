    @extends('adminheader.header')

    @section('header')
    
  <section class="content-header">
        <div class="row">

                            <div class="col-lg-5"></div> 
                            <div  class="col-lg-2  btn  btn-warning box-title-heder">
                            <h3 class="box-title  title" >   شــاشــة المصـــروفات </h3>
                            </div>
                             <div class="col-lg-5"></div>
                    </div>
        </section>
        
    @endsection


    @section('content')


        <style type="text/css">

        </style>
        
       
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box box-success">
<!--                        <div class="box-header">-->
<!--                            <h3 class="box-title">كل ما يتعلق بالمصروفات</h3>-->
<!--                        </div>-->
                        <div class="box-body">
                        

                                <div class="row" style="margin:10px;">
                                    <div class="panel with-nav-tabs panel-primary" style="margin-bottom: 18px;direction: ltr;">
                                        <div class="panel-heading">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#tab_expensesgroup" data-toggle="tab">  تعريف مجموعة مصروف جديدة</a></li>
                                                <li class=""><a href="#tab_expensestypes" data-toggle="tab">تعريف مصروف جديد</a></li>
                                                <li class=""><a href="#tab_expenses" data-toggle="tab">إدخال مصروف</a></li>
                                                <li class=""><a href="#tab_oneTotalExpense" data-toggle="tab">اجمالى مصروف واحد</a></li>
                                                <li class=""><a href="#tab_TotalExpenses" data-toggle="tab">اجمالى المصروفات</a></li>
                                                <li class=""><a href="#tab_GroupReport" data-toggle="tab"> اجمالى مجموعات المصروفات</a></li>
                                            </ul>
                                        </div>
                                    <div class="panel-body">
                                        <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;direction:rtl;padding:10px;">
                                            <div class="tab-pane active " id="tab_expensesgroup">
                                              <p>تحميل ...</p>
                                            </div>
                                            <div class="tab-pane  " id="tab_expensestypes">
                                              <p>تحميل ...</p>
                                            </div>
                                            <div class="tab-pane" id="tab_expenses">
                                              <p>تحميل ...</p>
                                            </div>
                                            <div class="tab-pane" id="tab_oneTotalExpense">
                                              <p>تحميل...</p>
                                            </div>
                                            <div class="tab-pane" id="tab_TotalExpenses">
                                              <p>تحميل ...</p>
                                            </div>
											<div class="tab-pane " id="tab_GroupReport">
                                              <p>تحميل ...</p>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    @endsection

    @section('footer_script')

        <script src={{asset('plugins/datatables/jquery.dataTables.js')}} type="text/javascript"></script>
        <script src={{asset("/plugins/datatables/dataTables.tableTools.js")}} type="text/javascript"></script>
          <script src={{asset('plugins/datatables/dataTables.bootstrap.js')}} type="text/javascript"></script>
              <script src={{asset("//cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js")}} type="text/javascript"></script>
   <script src={{asset("//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf")}} type="text/javascript"></script>
        <script type="text/javascript">
            // $("[data-widget='collapse']").click(function() {
            //     //Find the box parent        
            //     var box = $(this).parents(".box").first();
            //     //Find the body and the footer
            //     var bf = box.find(".box-body, .box-footer");
            //     if (!box.hasClass("collapsed-box")) {
            //         box.addClass("collapsed-box");
            //         bf.slideUp();
            //     } else {
            //         box.removeClass("collapsed-box");
            //         bf.slideDown();
            //     }
            // });

        countTabs = 0;
            AllcountTabs = 6;

            $('#tab_expensesgroup').load("{{('expensesgroup')}}",function() {ReloadCboDone();});
            $('#tab_expensestypes').load("{{('expensestypes')}}",function() {ReloadCboDone();});
            $('#tab_expenses').load("{{('expenses')}}" ,function() {ReloadCboDone();});
			$('#tab_oneTotalExpense').load("{{('onetotalexpenses')}}",function() {ReloadCboDone();});
            $('#tab_TotalExpenses').load("{{('totalexpenses')}}",function() {ReloadCboDone();});
            $('#tab_GroupReport').load("{{('expensesgroupreport')}}",function() {ReloadCboDone();});
            
   
            
            function ReloadCboDone(){
                countTabs ++;
                if (countTabs == AllcountTabs)
                    {
                         reloadcbo();
                    }
            }

        </script>

        </script>
<script> 
$(document).ready(function(){    
$("#link11").addClass("hoverlink");
});
</script>

    @endsection