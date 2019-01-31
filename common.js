function showCircle(duration){
    $('.circle-component__circle').each(function (index, elm) {
        var $elm = $(elm);
        var diameter = $elm.css("width").replace("px", "");
        var color = $elm.css("color")
        var value = $elm.attr("data-value") || 0;
        
        if(duration==undefined){
            duration=1200;
        }
        $elm.circleProgress({
            value: value,
            size: diameter,
            fill: {
                color: color
            },
            animation:{
                duration:duration
            }
        });

        $elm.find('.circle-component__value').html(100 * value);
    })

    $('#html').css("opacity", "1");
}

