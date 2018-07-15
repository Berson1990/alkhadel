<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Sales Reminder Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines are the default lines which match reasons
	| that are given by the password broker for a password update attempt
	| has failed, such as for an invalid token or invalid new password.
	|
	*/

	"home" => [
        'billnumber' => 'رقم الفاتورة',
        'date' => 'التاريخ',
        'supplier' => [
            'supplier' => 'الفلاح',
            'select' => 'ادخل اسم الفلاح'
        ],
        'customer' => [
            'customer' => 'التاجر',
            'select' => 'ادخل اسم التاجر'
        ],
        'commision' => [
            'commision' => 'العمولة',
            'inputcommision' => 'ادخل العمولة الخاصة بالفلاح',
        ],
        'carrying' => 'المشال',
        'allcarrying' => 'المشال الكلي',
        'totalquantity' => 'الكمية الكلية',
        'totalweight' => 'الوزن الكلي',
        'totaloftotal' => 'الاجمالي الكلي',
        'totalcommision' => 'اجمالي العمولة',

        'discount' => 'الخصم',
        'totaldiscount' => 'الاجمالى بعد المشال ',
		'totalAfterNolown'=>'النولون',
		'totalAfterCustdy'=>'العهدة ',	
		'Drivers'=>'اسم السائق',
        'Discountshow'=>'الخصم',	
        'finaltotal'=>'الاجمالى النهائي ',	
        'productname' => 'اسم المنتج',
        'weighttype' => 'الوازنة',
        'weightunit' => 'الوحدة',
        'weightkilo' => 'الكيلو',
        'weight' => 'الوزن',
        'quantity' => 'الكمية',
        'price' => 'السعر',
        'total' => 'الاجمالي',
        'serial' => 'المسلسل',
        'save' => 'حفظ',
        'sign' => 'علامة',
        'nowlon' => 'النولون',
        'custody' => 'العهدة',
        'driver' => 'السائق',
        'close' => 'اغلاق',
        'add' => 'أضافة',
        'update' => [
            'updatesupplier'=> 'تعديل صنف خاص بالتاجر',
            'update' => 'تحديث',
            'deletedeal' => 'حذف الاصناف المختارة',
            'updatemaster' => 'حفظ تعديلات بيانات الفاتورة'

        ],
        'salesdetailstitle' => 'تفاصيل خاصة بالمنتج',
        'salestitle' => 'الفاتورة',
        'confirmbox' => 'هل تريد حذف المنتج  ؟',
        'yes' => 'نعم',
        'no' => 'لا',
        'updatefullbill' => 'تعديل الفاتور ككل',


        'lblinfo' => [
            'bill' => 'رقم الفاتورة: هو الرقم الخاص بكل فاتورة سابقة ويتم تحديدها عن طريق اختيار التاجر والتاريخ',
            'salesdate' => 'التاريخ : هو التاريخ الخاص بكل عملية',
            'supplier' => 'الفلاح : هو المسئول عن انتاج المنتجات وبيعها للتاجر',
            'customer' => 'التاجر : هو العميل الذي يشتري المنتجات من الفلاح ',
            'commission' => 'العمولة : هي العمولة الخاصة بكل فلاح',
            'carrying' => 'المشال : هو المشال الخاص بالعمال الذين يقوموا بتحميل البضاعة',
            'discount' => 'الخصم : الخصم الخاص بالتاجر',
            'nowlon' => 'النولون : النولون الخاص بالتاجر',
            'driver' => 'السائق : السائق الخاص بالسفر',
            'custody' => 'العهدة : العهدة الخاصة بالسائق',
            'signs' => 'العلامة : رقم السيارة الخاصة بعميل الصعيد',
            'product' => 'المنتج',
            'unit' => 'الوحدة اما تكون بالوزنة او بالكيلو',
            'weight' => 'وزن المنت',
            'quantity' => 'الكمية',

        ],
        'enddeal' => [
//             'SalesID' => 'مهم',
            'valuesold' => 'القيمة المباعة',
            'billexpenses' => 'مصاريف الفاتورة',
            'internalbillexpenses' => ' م.الفاتوره الداخليه (عهدة + مشال +نولون -الخصم)',
            'estimatedvalue' => 'القيمة التقديرية',
            'netprofit-loss' => 'صافي الربح / الخسارة',
        ]
    ],

];
