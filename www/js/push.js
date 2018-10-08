document.addEventListener('deviceready', function () {
  // Enable to debug issues.
  //window.plugins.OneSignal.setLogLevel({logLevel: 4, visualLevel: 4});
  
  var notificationOpenedCallback = function(jsonData) {
    console.log('notificationOpenedCallback: ' + JSON.stringify(jsonData));
  };

  window.plugins.OneSignal
    .startInit("13933cf9-c711-4cc9-8a29-a33cb29041a2")
    .handleNotificationOpened(notificationOpenedCallback)
    .endInit();

	/*
	window.plugins.OneSignal.init("14b162b3-4125-4f89-af4e-741d0ff9e0f9",
                                 {googleProjectNumber: "294430135080"},
                                 notificationOpenedCallback);
	*/

	// Show an alert box if a notification comes in when the user is in your app.
	//window.plugins.OneSignal.enableInAppAlertNotification(true);
  
}, false);