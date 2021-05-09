global . $ = window . $ = require('jquery');
require('bootstrap/dist/js/bootstrap.bundle');
require('overlayscrollbars/js/jquery.overlayScrollbars');
require('./admin');
require('jquery-mousewheel/jquery.mousewheel');
require('lightbox2/src/js/lightbox');
require('sweetalert2/dist/sweetalert2');
require('select2/select2');


global.readURL = function(inputFile, imgId) {
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#'+imgId).attr('src', e.target.result);
            }
            reader.readAsDataURL(inputFile.files[0]);
        }
    }

         $(document).on('click','.delete_btn',function()
         {
            let confirmed = confirm("Are You Sure You Want To Delete This Data?");
            if(confirmed)
            {
                $(this).parent().find('form').submit();
            }
    });

setTimeout(function(){
            $('.alert').slideUp();
 }, 3000);

 
//  $('#brand_id').select2();