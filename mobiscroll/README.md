Mobiscroll
==========

## scroll-picker fork

The mobiscroll is a great project, and I wanted to use the mobiscroller together with a JQueryMobile anchor button instead of an input field. Unfortunately the scroller is hard-coded to bind to the focus event and it will take some modifications to bind to the click event instead. As a quick workaround, I was able to put the date/time input elements on a hidden page and then bind the anchor button click events to open the scroller.

I am actually using Cordova/PhoneGap with the native DatePicker plugin for a project, but it will not work for a web test version. For a quick replacement, I was able to define some functions to open the mobiscroll date/time pickers and receive a callback when the date is selected. I put a test in demo.html to show the mobiscroll date/time pickers working with the anchor buttons.

I believe there will be some cases when it may be useful to use the mobiscroller without binding to a document element, especially for projects that are not using JQuery. One example I thought of right now is using MGWT or GWT-Mobile, which are two different library frameworks that compile Java to Javascript. I think the mobiscroll project can become more beneficial by providing a solution that does not require binding to a JQuery element.

## About Mobiscroll

A wheel scroller user control optimized for touchscreens to easily enter date and/or time. The control can easily be customized to support any custom values and can even be used as an intuitive alternative to the native select control (dropdown list). It is designed to be used on touch devices as an alternative to the jQuery UI date picker.

The control is themable. You can easily change the appearance of if in CSS. It also comes with pre-defined, nice looking skins (Default, Android, Sense UI and iOS).

By default the control renders for intuitive and easy usage, but you can also customize it's parameters (width, height,...). For more info see the wiki.

See demo here: http://demo.mobiscroll.com

More features and details to follow...

Tested on iOS4, Android 2.2, Android 2.3, Chrome, Safari, Firefox, IE9. Please submit issues, and compatibility problems with other devices.

If you like it, spread the word!

For the latest info follow us on Twitter http://twitter.com/#!/mobiscroll !
Like us on Facebook http://www.facebook.com/pages/Mobiscroll/226962304011802 !

It'd be cool to see how you're using Mobiscroll!
================================================

We're looking at showcasing some of the best work on http://mobiscroll.com . Feel free to let us know on twitter @mobiscroll!

Changelog 1.6
===============

Bugfixes
--------

  * Fixed: Tap & hold changes the value on a 300ms interval instead of 200ms (for slower devices)

  * Fixed: When using custom wheels, parseValue function defaults to first value on the wheel, if cannot parse the input value to a valid wheel value

Enhancements
============

  * Added: _showLabel_ option - show/hide labels on the top of the wheels, default is *true*

  * Added: _showValue_ option - show/hide formatted value in the header of the popup, default is *true*

  * Added: Android ICS ('android-ics') and Android ICS Light ('android-ics light') skins

Changelog 1.5.3
===============

Bugfixes
--------

  * Fixed: Mouse scroll wheel works now with jQuery 1.7+

  * Fixed: Don't always parse input value on show, only if changed

  * Fixed: Time was incorrectly parsed, if there was no date

Changelog 1.5.2
===============

Bugfixes
--------

  * Fixed: First selected value did not work correctly by default for custom scrollers

  * Fixed: Incorerect parsing of am/pm time for 12:xx AM

Enhancements
------------

  * Added: animation on touchend/mouseup event

  * Added: full CSS3 support for Opera 11 and IE10

Changelog 1.5.1
===============

Bugfixes
--------

  * Fixed: Destroy didn't set correctly the original readonly state of the input element.

  * Fixed: Input element is not set to readonly if showOnFocus is false

  * Fixed: Disabled state of form inputs was not correctly reset after hiding the scroller.

  * Fixed: Don't show scroller if disabled and show is called programatically.

Enhancements
------------

  * Added: if the onClose handler returns false, close is now prevented.

  * Added: onCancel event handler.

Notes
-----

  * From now we are using .prop to set readonly/disabled states. This means thet jQuery >= 1.6 is required.

Changelog 1.5
=============

Bugfixes
--------

  * Fixed: _setDate_ method incorrectly sets year, when _seconds_ option is *false*

Enhancements
------------

  * Added: _mode_ option, with two possible values: 'scroller' and 'clickpick', where 'scroller' is the default behaviour, while 'clickpick' renders + and - buttons for each wheel (Android style).

  * Added: new and updated skins: Android, Sense UI, iOS. Set the _theme_ option to 'android', 'sense-ui' and 'ios'

Notes
-----

  * Support for jQuery Mobile 1.0beta1 is now removed (click event was not working). Upgrade to beta2 to use the latest version of MobiScroll.

Known Issues
------------

  * 'Scroller' mode is still not working in Firefox Mobile and IE on WP7

  * When using 'Clickpick' mode, very fast taps causes page zoom on HTC Android.

Changelog 1.0.2
===============

Bugfixes
--------

  * Fixed: Click bleedtrough and focus holding with JQM beta 1
  * Fixed: Missing hour 0 on timepicker

Enhancements
------------

  * Added: Date format options for date wheels through the dateOrder option
