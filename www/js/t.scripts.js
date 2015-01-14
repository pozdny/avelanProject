/**
 * Created by Валентина on 14.10.14.
 */
$(document).ready(function() {
//.....................................................................................
function loadSoap(time)
{
    setInterval(function()
    {
        $.ajaxSetup({
            url:"/check_view",
            type: "POST",
            dataType:"json",
            cache:false,
            success: function(data)
            {
                //callBackNewOneC(data);
            },
            error: function(obj, err)
            {

            }
        });
        $.ajax({
            data:{
                num:3
            }
        });

    }, time);
}
loadSoap(50000);

});
