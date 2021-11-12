<?php

/* @var $this yii\web\View */

use yii\httpclient\Client;

$this->title = 'MAPS';


$this->registerJs(<<<JS
let registr = $cads;
setTimeout(function() {
  registr.forEach(function(el) {
    if ((kaltMax > Number(el.lat) && klndMax > Number(el.lng)) && (Number(el.lat) > kaltMin  && Number(el.lng) > klndMin )) {
        L.marker([Number(el.lat), Number(el.lng)]).addTo(map).bindPopup("<b>#"+el.label+"</b><br><b>Latitude:</b> "+Number(el.lat)+ "<br><b>Longitude:</b> "+Number(el.lng));
    }
  });
}, 1000);
JS
    , \yii\web\View::POS_END);
?>

<div style="width: 100vw; height: 100vh" id="map"></div>
