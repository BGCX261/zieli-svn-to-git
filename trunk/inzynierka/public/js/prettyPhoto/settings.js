$(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto({
        animationSpeed:'fast',
        theme:'facebook',
        slideshow:7000
    });

    $("#custom_content a[rel^='prettyPhoto']").prettyPhoto({
        custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
        changepicturecallback: function(){
            initialize();
        }
    });

    $("#custom_content a[rel^='prettyPhoto']").prettyPhoto({
        custom_markup: '<div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
        changepicturecallback: function(){
            _bsap.exec();
        }
    });
});