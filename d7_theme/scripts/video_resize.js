(function($) {
  Drupal.behaviors.client_video_resize = {
    attach: function(context, settings) {

    $(window).load(function() {
      var $allVideos = $("iframe[src^='//www.youtube.com']"),
        $fluidEl = $(".field-item, #cboxLoadedContent");
          // Figure out and save aspect ratio for each video
          $allVideos.each(function() {
            $(this).data('aspectRatio', this.height / this.width)
            // and remove the hard coded width/height
            .removeAttr('height').removeAttr('width');
          });

          // When the window is resized
          $(window).resize(function() {
            console.log($allVideos);
            $fluidEl = $(".field-item, #cboxLoadedContent");
            var newWidth = $fluidEl.width();
            // Resize all videos according to their own aspect ratio
            $allVideos.each(function() {
              var $el = $(this);
              $el.width(newWidth).height(newWidth * $el.data('aspectRatio'));
            });
            // Kick off one resize to fix all videos on page load
          }).resize();

          // Do video resizing on videos in colorboxes!
          $('.colorbox-load').colorbox({onComplete:function(){
            console.log('colorbox loaded');
            console.log($allVideos);
            $fluidEl = $("#cboxContent");
            var newWidth = $fluidEl.width();
            // Resize all videos according to their own aspect ratio
            $allVideos.each(function() {
              var $el = $(this);
              $el.width(newWidth).height(newWidth * $el.data('aspectRatio'));
            });
          }});
    });
  });
})(jQuery);
