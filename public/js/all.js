$(document).ready(function() {
	$('.sort').click(function() {
        sortType = $(this).attr('data-sort-type');
       setAttr('SORT', sortType);
    });

    $('.pagination-btn').click(function() {
        pageNumber = $(this).attr('data-pg-id');
        console.log(pageNumber);
        setAttr('PAGE', pageNumber);
    });

    $('.logout').click(function(){
        $.ajax({
			type: 'post',
			url: '/logout',
            success:function(){
                location.reload();
            }
        });

    });

    function setAttr(name, val){
        var res = '';
        var d = location.href.split("#")[0].split("?");
        var base = d[0];
        var query = d[1];
        if(query) {
            var params = query.split("&");
            for(var i = 0; i < params.length; i++) {
                var keyval = params[i].split("=");
                if(keyval[0] != name) {
                    res += params[i] + '&';
                }
            }
        }
        res += name + '=' + val;
        window.location.href = base + '?' + res;
        return false;
    }
});