/**
 * Constants used throughout javascript
 */

var clientConstants = {
  // media query constants to make it easier to figure out in js what breakpoint we're at.
  // These same values are defined in less variables and assigned in css (see themes/custom/client/less/base/helpers.less)
  MEDIA_QUERY_BASE:         '1px',
  MEDIA_QUERY_MIN_WIDTH_SM: '2px',
  MEDIA_QUERY_MIN_WIDTH_MD: '3px',
  MEDIA_QUERY_MIN_WIDTH_LG: '4px'
};
/**
 * @file
 * Custom scripts for theme.
 */

/**
 *  Vanilla JS dom ready function. Can use jQuery ready() instead if theme ends up using jQuery.
 * @param fn
 */
function ready(fn) {
  if (document.readyState != 'loading') {
    fn();
  }
  else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

/**
 * Debounce function. Use to debounce any actions attached to window resize event
 * @param func
 * @param wait
 * @param immediate
 * @returns {Function}
 */

function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) {
        func.apply(context, args);
      }
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) {
      func.apply(context, args);
    }
  };
}