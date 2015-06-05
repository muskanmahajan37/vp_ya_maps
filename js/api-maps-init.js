var $ = jQuery.noConflict();
$(document).ready(function () {

    function init_maps(center , zoom) {
        ymaps.ready(function () {
            var myMap = new ymaps.Map('YMapsID', {
                    center: center,
                    zoom: zoom,
                    behaviors: ['default', 'scrollZoom']
                }),
            // Создание кнопки определения местоположения
                geolocationButton = new GeolocationButton({
                    data: {
                        image: '/wp-content/plugins/vp_ya_maps/images/wifi.png',
                        title: 'Определить местоположение'
                    },
                    geolocationOptions: {
                        enableHighAccuracy: true // Режим получения наиболее точных данных
                    }
                }, {
                    // Зададим опции для кнопки.
                    selectOnClick: false
                });

            myMap.behaviors.disable('scrollZoom');

            myMap.controls
                .add('mapTools')
                .add(new CrossControl)
                .add(geolocationButton, {top: 5, left: 100})
                .add('zoomControl')
                .add('typeSelector', {top: 5, right: 5})
                .add(new ymaps.control.SearchControl({noPlacemark: true}), {top: 5, left: 200});
                new LocationTool(myMap);

           });
    }

    if($('#YMapsID').length || $('#YMapsID').attr('data-geo') =='' ) {

        var data = JSON.parse( $('#YMapsID').attr('data-geo'));
        $("#markerPosition").attr('value',data.placemarct);

        init_maps(data.center.split(','), Number(data.mapzoom));
    }
});
