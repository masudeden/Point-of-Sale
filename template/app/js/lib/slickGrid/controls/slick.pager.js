(function ($) {
  function SlickGridPager(dataView, grid, $container) {
    var $status;

    function init() {
      dataView.onPagingInfoChanged.subscribe(function (e, pagingInfo) {
        updatePager(pagingInfo);
      });

      constructPagerUI();
      updatePager(dataView.getPagingInfo());
    }

    function getNavState() {
      var cannotLeaveEditMode = !Slick.GlobalEditorLock.commitCurrentEdit();
      var pagingInfo = dataView.getPagingInfo();
      var lastPage = pagingInfo.totalPages - 1;

      return {
        canGotoFirst: !cannotLeaveEditMode && pagingInfo.pageSize != 0 && pagingInfo.pageNum > 0,
        canGotoLast: !cannotLeaveEditMode && pagingInfo.pageSize != 0 && pagingInfo.pageNum != lastPage,
        canGotoPrev: !cannotLeaveEditMode && pagingInfo.pageSize != 0 && pagingInfo.pageNum > 0,
        canGotoNext: !cannotLeaveEditMode && pagingInfo.pageSize != 0 && pagingInfo.pageNum < lastPage,
        pagingInfo: pagingInfo
      }
    }

    function setPageSize(n) {
      dataView.setRefreshHints({
        isFilterUnchanged: true
      });
      dataView.setPagingOptions({pageSize: n});
    }

    function gotoFirst() {
      if (getNavState().canGotoFirst) {
        dataView.setPagingOptions({pageNum: 0});
      }
    }

    function gotoLast() {
      var state = getNavState();
      if (state.canGotoLast) {
        dataView.setPagingOptions({pageNum: state.pagingInfo.totalPages - 1});
      }
    }

    function gotoPrev() {
      var state = getNavState();
      if (state.canGotoPrev) {
        dataView.setPagingOptions({pageNum: state.pagingInfo.pageNum - 1});
      }
    }

    function gotoNext() {
      var state = getNavState();
      if (state.canGotoNext) {
        dataView.setPagingOptions({pageNum: state.pagingInfo.pageNum + 1});
      }
    }

    function constructPagerUI() {
      $container.empty();

      var $nav = $("<span class='slick-pager-nav' />").appendTo($container);
      var $settings = $("<span class='slick-pager-settings' />").appendTo($container);
      $status = $("<span class='slick-pager-status' />").appendTo($container);

      $settings
          .append("<span class='slick-pager-settings-expanded'>Show: <a data=0 class='settings_expanded_active'>All</a><a data='-1'>Auto</a><a data=25>25</a><a data=50>50</a><a data=100>100</a></span>");

      $settings.find("a[data]").click(function (e) {
        $settings.find("a[data]").removeClass('settings_expanded_active')
		$(this).addClass('settings_expanded_active');
		var pagesize = $(e.target).attr("data");
        if (pagesize != undefined) {
          if (pagesize == -1) {
            var vp = grid.getViewport();
            setPageSize(vp.bottom - vp.top);
          } else {
            setPageSize(parseInt(pagesize));
          }
        }
      });

      var icon_prefix = "<span class='slick-item-nav'><i class='";
      var icon_suffix = "' /></span>";

      //$(icon_prefix + "ui-icon-lightbulb" + icon_suffix)
      //    .click(function () {
      //      $(".slick-pager-settings-expanded").toggle()
      //    })
      //    .appendTo($settings);

      $(icon_prefix + "icon-double-angle-left" + icon_suffix)
          .click(gotoFirst)
          .appendTo($nav);

      $(icon_prefix + "icon-angle-left" + icon_suffix)
          .click(gotoPrev)
          .appendTo($nav);

      $(icon_prefix + "icon-angle-right" + icon_suffix)
          .click(gotoNext)
          .appendTo($nav);

      $(icon_prefix + "icon-double-angle-right" + icon_suffix)
          .click(gotoLast)
          .appendTo($nav);

      //$container.find(".ui-icon-container")
      //    .hover(function () {
      //      $(this).toggleClass("ui-state-hover");
      //    });

      $container.children().wrapAll("<div class='slick-pager' />");
    }


    function updatePager(pagingInfo) {
      var state = getNavState();

      $container.find(".slick-pager-nav span").removeClass("slick-item-nav-disabled");
      if (!state.canGotoFirst) {
        $container.find(".icon-double-angle-left").parent('span').addClass("slick-item-nav-disabled");
      }
      if (!state.canGotoLast) {
        $container.find(".icon-double-angle-right").parent('span').addClass("slick-item-nav-disabled");
      }
      if (!state.canGotoNext) {
        $container.find(".icon-angle-right").parent('span').addClass("slick-item-nav-disabled");
      }
      if (!state.canGotoPrev) {
        $container.find(".icon-angle-left").parent('span').addClass("slick-item-nav-disabled");
      }

      if (pagingInfo.pageSize == 0) {
        $status.text("Showing all " + pagingInfo.totalRows + " rows");
      } else {
        $status.text("Showing page " + (pagingInfo.pageNum + 1) + " of " + pagingInfo.totalPages);
      }
    }

    init();
  }

  // Slick.Controls.Pager
  $.extend(true, window, { Slick:{ Controls:{ Pager:SlickGridPager }}});
})(jQuery);
