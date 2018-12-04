$( document ).ready(function() {
    $("#clearInput").on('click', function(){
        document.getElementById('search').value = '';
        $('html').animate({
            scrollTop: 0
        }, 180);
    });
});
