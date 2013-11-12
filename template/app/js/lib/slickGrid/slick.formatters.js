/***
 * Contains basic SlickGrid formatters.
 * 
 * NOTE:  These are merely examples.  You will most likely need to implement something more
 *        robust/extensible/localizable/etc. for your use!
 * 
 * @module Formatters
 * @namespace Slick
 */

(function ($) {
  // register namespace
  $.extend(true, window, {
    "Slick": {
      "Formatters": {
        "PercentComplete": PercentCompleteFormatter,
        "PercentCompleteBar": PercentCompleteBarFormatter,
        "YesNo": YesNoFormatter,
        "Checkmark": CheckmarkFormatter
      }
    }
  });

  function PercentCompleteFormatter(row, cell, value, columnDef, dataContext) {
    if (value == null || value === "") {
      return "-";
    } else if (value < 50) {
      return "<div class=\"progress progress-small\"><div style=\"width: " + value + "%\" class=\"progress-bar progress-bar-danger\"></div></div>";
    } else {
      return "<div class=\"progress progress-small\"><div style=\"width: " + value + "%\" class=\"preogress-bar progress-bar-success\"></div></div>";
    }
  }

  function PercentCompleteBarFormatter(row, cell, value, columnDef, dataContext) {
    if (value == null || value === "") {
      return "";
    }

    var color;

    if (value < 30) {
      color = "progress-bar-danger";
    } else if (value < 70) {
      color = "progress-bar-warning";
    } else {
      color = "progress-bar-success";
    }

    return "<div class=\"progress progress-small\"><div style=\"width: " + value + "%\" class=\"progress-bar " + color + "\"></div></div>";
  }

  function YesNoFormatter(row, cell, value, columnDef, dataContext) {
    return value ? "Yes" : "No";
  }

  function CheckmarkFormatter(row, cell, value, columnDef, dataContext) {
    return value ? "<i class=\"icon-ok\"></i>" : "";
  }
})(jQuery);
