/*$(document).ready(function(){
    if(document.getElementById('post_published').checked == true)
    {
        document.getElementById('post_published').setAttribute('value', '1');
    }
    else if(document.getElementById('post_published').checked == false)
    {
        document.getElementById('post_published').setAttribute('value', '0');
    }    
});*/

/*$(function() {
    $('input[name="post_published"]').change(function() {
        var $t = $(this);
        if ( $t.attr('value','1'))
        {
            $('input[name="post_published"]').attr('value','0');
        }
        else
        {
            $('input[name="post_published"]').attr('value','1');
        }
    });
});*/
$(function() {
    $('input[name="post_published"]').change(function() {
            var $t = $(this);
            if ( !$t.attr('checked'))
            {
                $t.after('<input type="hidden" name="foo" value="0" />');
            }
            else
            {
                $t.next().remove();
            }
    });
});