function showCircle(duration) {
    
    if (duration == undefined) {
        duration=0;
    }

    $('.circle-component__circle').each(function (index, elm) {
        var $elm = $(elm);
        var diameter = $elm.css("width").replace("px", "");
        var color = $elm.css("color")
        var value = $elm.attr("data-value") || 0;
        var dur = duration;
        var percentValue= value*0.01;
        dur = dur*percentValue;

        if(value<40){
            color="black";
        }else if(value<70){
            color="#36bf68"
        }else{
            color="#E44F3F";
        }

        $elm.circleProgress({
            value: percentValue,
            size: diameter,
            fill: {
                color: color
            },
            animation: {
                duration: dur
            }
        });

        $elm.find('canvas').css("width","100%");
        $elm.find('canvas').css("height","100%");

        if(dur<=100){
            $elm.find('.circle-component__value').text(value);
            return;
        }

        $elm.on("circle-animation-progress",function(event, progress){
            var value = $elm.attr("data-value");
            $elm.find('.circle-component__value').html(Math.floor(value*progress));
        });
        
    })
}

$(function(){
    $('.gnb__item').mouseover(function () {
        $(this).find(".gnb__item-underline").stop().animate({ width: "100%" }, 150, "swing");
        
    }).mouseleave(function () {
        $(this).find(".gnb__item-underline").stop().animate({ width: "0" }, 200, "swing");
    });
    
    $('#html').css("opacity", "1");
    
});


