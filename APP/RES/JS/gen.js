$(document).ready(function() {

    //EVENTS
    $('a.scroll').click(function() {
        $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top - 60
            },
            500, 'easeOutExpo');
    });

    $('.modal').on('show.bs.modal', function(e) {
        var scope = this;
        var maxZ = 1050;
        $("body").find(".modal.in").each(function() {
            var thisZ = $(this).css("z-index");
            if (thisZ > maxZ) maxZ = thisZ;
        });
        $(scope).css("z-index", ++maxZ);
    });
    
    $('input[type="number"]').change(function(){
        var value = $(this).val();
        if(value>parseInt($(this).attr('max')))
            value = $(this).attr('max');
        else if($(this).val()<parseInt($(this).attr('min')))
            value = $(this).attr('min');
        
        $(this).val(parseFloat(value));
    });
});

function resetForm(form) {
    $(form).find("input").each(function() {
        $(this).val('');
    });
}