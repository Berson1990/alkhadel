
function load_expenses()
{

     var y = BootstrapDialog.show
        ({
            message: function(dialog) {
                var $message = $('<div></div>');
                var pageToLoad = dialog.getData('pageToLoad');
                $message.load(pageToLoad);
        
                return $message;
            },
            data: {
                'pageToLoad': 'expense'
            },
            onshow: function(dialogRef){
                // alert('Dialog is popping up, its message is ' + dialogRef.getMessage());
            },
            onshown: function(dialogRef){
                // alert('Dialog is popped up.');
            },
            onhide: function(dialogRef){
                 // $(this).remove();

                 $(this).data('modal', null);
                // alert('Dialog is popping down, its message is ' + dialogRef.getMessage());
            },
            onhidden: function(dialogRef){
                 // $(this).remove();
                 $(this).data('modal', null);
                // alert('Dialog is popped down.');
            },
            closable: true,
            closeByBackdrop: false,
            closeByKeyboard: false,
            size:BootstrapDialog.SIZE_WIDE
        });


}


function load_expensestypes()
{

     var x = BootstrapDialog.show
        ({
            message: function(dialog) {
                var $message = $('<div></div>');
                var pageToLoad = dialog.getData('pageToLoad');
                $message.load(pageToLoad);
        
                return $message;
            },
            data: {
                'pageToLoad': 'expensestypes'
            },
            onshow: function(dialogRef){
                // alert('Dialog is popping up, its message is ' + dialogRef.getMessage());
            },
            onshown: function(dialogRef){
                // alert('Dialog is popped up.');
            },
            onhide: function(dialogRef){
                 // $(this).remove();

                 $(this).data('modal', null);
                // alert('Dialog is popping down, its message is ' + dialogRef.getMessage());
            },
            onhidden: function(dialogRef){
                 // $(this).remove();
                 $(this).data('modal', null);
                // alert('Dialog is popped down.');
            },
            closable: true,
            closeByBackdrop: false,
            closeByKeyboard: false,
            size:BootstrapDialog.SIZE_WIDE
        });


}