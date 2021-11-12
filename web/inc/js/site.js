const map = new L.Map('map', { center: new L.LatLng(0, 0), zoom: 0 });
const osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
var track, kalt = [], klnd = [], kaltMax, klndMax, kaltMin, klndMin;
map.addLayer(osm);
fetch('inc/files/zone.kml')
    .then(res => res.text())
    .then(kmltext => {
        track = new L.KML((new DOMParser()).parseFromString(kmltext, 'text/xml'));
        map.addLayer(track);

        track.latLngs.forEach(function (el) {
                kalt.push(el.lat);
                klnd.push(el.lng);
        });

        kaltMax = Math.max.apply(null, kalt);
        klndMax = Math.max.apply(null, klnd);
        kaltMin = Math.min.apply(null, kalt);
        klndMin = Math.min.apply(null, klnd);
        map.fitBounds(track.getBounds());
    });
