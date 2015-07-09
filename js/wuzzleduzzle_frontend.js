(function($) {

// Breakpoints
// via sass/utils/_vars.scss
// Used by $.matchmedia() in various behaviors.
Drupal.settings.breakpoints = {
  tablet: 'all and (min-width: 740px)',
  desktop: 'all and (min-width: 980px)',
  big_desktop: 'all and (min-width: 1225px)'
};

Drupal.settings.imgstyles = {
  '4col_keystone_sm': {
    'tablet': "4col_keystone_sm",
    'desktop': "4col_keystone_sm",
    'big_desktop': "6col"
  },
  '5col_keystone_md': {
    'tablet': "4col_keystone_sm",
    'desktop': "5col_keystone_md",
    'big_desktop': "7col_keystone_lg"
  },
  '7col_keystone_lg': {
    'tablet': "4col_keystone_sm",
    'desktop': "7col_keystone_lg",
    'big_desktop': "9col"
  },
  '8col_medium_responsive': {
    'tablet': "8col_medium_responsive",
    'desktop': "12col",
    'big_desktop': "14col"
  },
  '10col_large_responsive': {
    'tablet': "10col_large_responsive",
    'desktop': "14col",
    'big_desktop': "18col"
  },
};

/**
 * changes the dom for different layout sizes.
 */
Drupal.theme.prototype.equalColumns = function() {
  // Ensure Content Height equals Sidebar.
  var brandingHeight = $('.branding').outerHeight();
  $('.l-content').css('min-height', brandingHeight);
};

/**
 * Build a selectnav given a Drupal menu ul, and append it after the ul
 *
 * @param $menuUl
 *   jQuery menu ul object
 *
 * @param int menuNum
 *   identifier for navtoselect
 *
 * @return nothing
 */
/*Drupal.theme.prototype.buildSelectnav = function($menuUl, menuNum) {
  var menuID = 'navtoselect-' + menuNum;
  $menuUl.attr('id', menuID);
  selectnav(menuID, {label:false});
  // Hide the label...
  $('#selectnav' + menuNum + ' option:eq(0)').remove();
};*/

/**
 * Replace image style settings for new breakpoint
 *
 * @param array imgstyles
 *   Objects of image styles in the format:
 *   [ { breakpoint: 'size', breakpoint: 'size' }, { ... } ]
 *
 * @param string breakpoint
 *   Target breakpoint
 *
 * @param domobject img
 *   Image DOM object
 *
 */
Drupal.theme.prototype.respondImg = function(imgstyles, breakpoint, img) {
  // Iterate through the responsive image styles.
  $.each(imgstyles, function(responsive_idx, obj) {
    // Check that responsive image style matches the current image style.
    if ($(img).hasClass('image-' + responsive_idx)) {
      // Get new style based on the current breakpoint.
      var new_style = obj[breakpoint];
      //console.log("old style: " + responsive_idx);
      //console.log("new style: " + new_style);

      // Only replace img if needed.
      if (img.src.indexOf(new_style) === -1) {
        // Replace image with new image style.
        img.removeAttribute('height');
        img.removeAttribute('width');
        img.src = img.src.replace(/styles\/.*\/public/, 'styles/' + new_style + '/public');
      }
    }
  });
};

/**
 * Equalize caption and img widths
 */
Drupal.theme.prototype.imgCaptionEqualize = function (img) {
  var $caption = $(img).siblings('p, figcaption, header');
  $caption.width($(img).width());
};

/**
 * changes the dom for different layout sizes.
 */
Drupal.theme.prototype.layoutResizeChanges = function() {
  var isFront = $('body').hasClass('front');
  var images = $('.l-content img');

  var i, l, mediabreak;
  if ($.matchmedia(Drupal.settings.breakpoints.tablet)) {
    mediabreak = 'tablet';
    if ($.matchmedia(Drupal.settings.breakpoints.desktop)) {
      mediabreak = 'desktop';
      if ($.matchmedia(Drupal.settings.breakpoints.big_desktop)) {
        mediabreak = 'big_desktop';
      }
    }
    for (i = 0, l = images.length; i < l; i += 1) {
      Drupal.theme('respondImg', Drupal.settings.imgstyles, mediabreak, images[i]);
      Drupal.theme('imgCaptionEqualize', images[i]);
    }
  }
  else {
  }

};

/**
 * Resize event for switching between layouts.
 */
Drupal.behaviors.resizeEnd = {
  attach: function (context, settings) {
    $(window).load(function() {
      Drupal.theme('layoutResizeChanges');
      $(window).bind('resizeend', function() {
        Drupal.theme('layoutResizeChanges');
      });
    });
  }
};

/**
 * Do imgsizer and captions on some images
 */
Drupal.behaviors.imgBits = {
  attach: function (context, settings) {
    // imgresize
    if (document.getElementById && document.getElementsByTagName) {
      imgSizer.collate($('img', context));
    }
  }
};

/**
 * Mobile menu collapse button.
 */
Drupal.theme.prototype.mobileMenu = function() {
  if ($('.menu-button').length === 0) {
    $('#block-system-main-menu').prepend('<div class="menu-button"><a href="#">Menu +</a></div>');
    var menuButton = $('#block-system-main-menu .menu-button a');
    $(menuButton).click( function(ev) {
      ev.preventDefault();
      $('#block-system-main-menu ul').toggleClass('expanded').slideToggle();
      var menuButtonText = $(menuButton).text();
      if (menuButtonText == 'Menu -') {
        $(menuButton).text('Menu +');
      } else {
        $(menuButton).text('Menu -');
      }
    });
  }
};

/**
 * Grid toggler.
 */
Drupal.theme.prototype.addGridToggle = function() {
  $('.admin-menu-shortcuts ul').append('<li><a id="grid-toggle" href="">Toggle Grid Columns</a></li>');
  $('#grid-toggle').click(function(ev) {
    ev.preventDefault();
    var wrappers = ['.l-header-wrapper','.l-content-wrapper','.l-footer-wrapper'];
    for (var i = 0; i < wrappers.length; i++) {
      $(wrappers[i]).toggleClass('show-columns');
    }
  });
};

/**
 * Apply initial design tweaks
 */
Drupal.behaviors.wdInit = {
  attach: function (context, settings) {
    $('div.file img').removeAttr('height');
    if ($('body').hasClass('logged-in')) {
      // Add grid toggler.
      Drupal.theme('addGridToggle');
    }
    // Add menu collapse button.
    Drupal.theme('mobileMenu');
    // Minimize menu if not front
    if ($('body').hasClass('not-front')) {
      $('#block-system-main-menu ul').hide();
    }
    // Re-position boxes into their wrappers.
    if ($('body').hasClass('node-type-project')) {
      $('.client-quote').appendTo($('#references-wrapper'));
      $('.services').appendTo($('#services-provided-wrapper'));
    }
    // Modify filter work options
    if ($('#edit-field-project-services-tid', context).length === 1) {
      var filterselect = $('#edit-field-project-services-tid', context);
      var text = $('label[for="edit-field-project-services-tid"]').text();
      $('label[for="edit-field-project-services-tid"]').remove();
      filterselect.find('option[value=All]').first().text(text);
      filterselect.append('<option value="All">Show all</option>');
    }
  }
};

})(jQuery);

