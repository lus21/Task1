$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.search_button').click(function(){
        $('.show').removeClass('show');
        $('tbody').empty();
        var first_name=$('#ex1').val();
        var last_name=$('#ex2').val();
        var keywords=$('#ex3').val();
        $.ajax({
            url:'/search',
            type:'post',
            data:{first_name,last_name,keywords},
            dataType:'json',
            success:function(res){
                if(res==''){
                    $('.no_results').addClass('show');
                }else{
                    var i;
                    for(i=0;i<res.length;i++){
                        $('tbody').append('<tr><td>'+res[i]['f_name']+'</td><td>'+res[i]['l_name']+'</td><td>'+res[i]['keywords']+'</td><td><a href="uploads/'+res[i]['resume']+'" download>'+res[i]['resume']+'</a></td></tr>');
                        $('.search_results').addClass('show');
                    }
                }
            }
        })
    })
})

