importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');

var firebaseConfig = {
    apiKey: "AIzaSyDnzyFGwNS2YlbeD0wdFCL1OVycC5zd51I",
    authDomain: "kodaslive-9beb6.firebaseapp.com",
    projectId: "kodaslive-9beb6",
    storageBucket: "kodaslive-9beb6.appspot.com",
    messagingSenderId: "600945585323",
    appId: "1:600945585323:web:c71d104222c0b98f7adbee",
    measurementId: "G-19H096V4JT"
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log(payload);
    const notification = JSON.parse(payload);
    const notificationOption = {
        body: notification.body,
        icon: notification.icon
    };
    return self.registration.showNotification(payload.notification.title, notificationOption);
});