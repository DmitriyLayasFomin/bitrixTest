<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>


<script src="/assets/js/jquery-3.5.0.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script>
        
        $(document).ready(function () {
            $(".card").click(function(e) {
                var id = e.currentTarget.getAttribute("dataid");
                $.ajax({
                type: 'POST',
                url: '/api.php',
                data: {command: "incard", id: id},
                success: function(data){
                    console.log(data);
                    if(data === 'true'){
                        $(e.currentTarget).addClass("incard");
                        $(e.currentTarget).html('Убрать');
                    }else if(data === 'false'){
                        $(e.currentTarget).removeClass("incard");
                        $(e.currentTarget).html("В корзину");
                    }
                }
		    });
            });
        });
    </script>
</body>

</html>