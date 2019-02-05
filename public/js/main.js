$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function($){
        $('button').click(function(){
            var direction = $(this).val();
            $.post("/",
            {
                direction: direction
            },)
            alert(direction);
        });
        });