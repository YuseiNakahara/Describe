
<script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(".navTitle").click(function(){
        var $subList = $(this).children('ul');
        if($subList.css('display') == 'none'){
          $subList.slideDown(500);
        }else{
          $subList.slideUp(500);
        }
    });

    $(function(){
        var modal = $('#modal'),
            modalContent = $('#modal_content'),
            btnOpen = $("#btn_open"),
            btnClose = $(".btn_close");

        $(btnOpen).on('click', function() {
            modal.show();
        });

        $(modal).on('click', function(event) {
            if(!($(event.target).closest(modalContent).length)||($(event.target).closest(btnClose).length)){
            modal.hide();
            }
        });
    });
</script>