function googlemapload(c, a, e) {
    if (GBrowserIsCompatible()) {
        var b = new GMap2(document.getElementById("googlemap"));
        b.addControl(new GSmallMapControl);
        b.addControl(new GMapTypeControl);
        c = new GLatLng(c, a);
        b.setCenter(c, e);
        geocoder = new GClientGeocoder;
        var d = new GMarker(c, {
            draggable: !0
        });
        b.addOverlay(d);
        GEvent.addListener(d, "dragend", function() {
            var a = d.getPoint();
            b.panTo(a);
            $('#gmap_lng').val( a.lng().toFixed(5) );
            $('#gmap_lat').val( a.lat().toFixed(5) );
        });
        GEvent.addListener(b, "moveend", function() {
            b.clearOverlays();
            var a = b.getCenter(),
                d = new GMarker(a, {
                    draggable: !0
                });
            b.addOverlay(d);
            $('#gmap_lng').val( a.lng().toFixed(5) );
            $('#gmap_lat').val( a.lat().toFixed(5) );
            GEvent.addListener(d, "dragend", function() {
                var a = d.getPoint();
                b.panTo(a);
                $('#gmap_lng').val( a.lng().toFixed(5) );
                $('#gmap_lat').val( a.lat().toFixed(5) );
            })
        })
    }
}

function showAddress(c) {
    var a = new GMap2(document.getElementById("googlemap"));
    a.addControl(new GSmallMapControl);
    a.addControl(new GMapTypeControl);
    geocoder && geocoder.getLatLng(c, function(e) {
        if (e) {
            a.clearOverlays();
            a.setCenter(e, 14);
            $('#gmap_lng').val( e.lng().toFixed(5) );
            $('#gmap_lat').val( e.lat().toFixed(5) );
            var b = new GMarker(e, {
                draggable: !0
            });
            a.addOverlay(b);
            GEvent.addListener(b, "dragend", function() {
                var d = b.getPoint();
                a.panTo(d);
                $('#gmap_lng').val( d.lng().toFixed(5) );
                $('#gmap_lat').val( d.lat().toFixed(5) );
            });
            GEvent.addListener(a, "moveend", function() {
                a.clearOverlays();
                var b = a.getCenter(),
                    c = new GMarker(b, {
                        draggable: !0
                    });
                a.addOverlay(c);
                $('#gmap_lng').val( b.lng().toFixed(5) );
                $('#gmap_lat').val( b.lat().toFixed(5) );
                
                GEvent.addListener(c, "dragend", function() {
                    var b = c.getPoint();
                    a.panTo(b);
                    $('#gmap_lng').val( b.lng().toFixed(5) );
                    $('#gmap_lat').val( b.lat().toFixed(5) );
                })
            })
        } else alert(c + " not found"), document.getElementById("url_google_map").value = ""
    })
};

function googlemapshow(c, a, e) {
   if(GBrowserIsCompatible()) {
      var b = new GMap2(document.getElementById("googlemap"));
      b.addControl(new GSmallMapControl);
      b.addControl(new GMapTypeControl);
      c = new GLatLng(c, a);
      b.setCenter(c, e);
      geocoder = new GClientGeocoder;
      var d = new GMarker(c,
      {
         draggable :!0}
      );
      b.addOverlay(d);
      GEvent.addListener(d, "dragend", function() {
         var a = d.getPoint(); b.panTo(a); 
         $('#gmap_lng').val( a.lng().toFixed(5) );
         $('#gmap_lat').val( a.lat().toFixed(5) );
         }
      );
      }
   }