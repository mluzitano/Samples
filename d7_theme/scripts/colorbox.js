(function ($, Drupal, window, document, undefined) {

	//Configure colorbox call back to resize with custom dimensions
  $.colorbox.settings.onLoad = function() {
    colorboxResize();
  }

  //Customize colorbox dimensions
  var colorboxResize = function(resize) {
    var width = "90%";
    var height = "90%";

		if($(window).width() > 1080) { width = "980"}
    if($(window).width() > 960) { width = "860" }
    if($(window).height() > 700) { height = "630" }


    $.colorbox.settings.height = height;
    $.colorbox.settings.width = width;

    //if window is resized while lightbox open
    if(resize) {
      $.colorbox.resize({
        'height': height,
        'width': width
      });
    }
  }

  //In case of window being resized
  $(window).resize(function() {
    colorboxResize(true);
  });

})(jQuery, Drupal, this, this.document);
