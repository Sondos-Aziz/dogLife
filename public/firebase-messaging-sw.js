/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
// importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');

importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyDl1VHYiwK1cZJLv-_qS9J2bjAOm3HnHk4",
    authDomain: "doglife-e7de0.firebaseapp.com",
    projectId: "doglife-e7de0",
    storageBucket: "doglife-e7de0.appspot.com",
    messagingSenderId: "659823965436",
    appId: "1:659823965436:web:7dab5f7296773f023cd379",
    measurementId: "G-YPYJ9WYZ96"

});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  return self.registration.showNotification(
      notificationTitle,
      notificationOptions,
      );
});