
// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyA9JgafzSI3UfbTHacQwvWg9cjaxoF5ZY8",
  authDomain: "sistem-parking-counter-ft-uns.firebaseapp.com",
  databaseURL: "https://sistem-parking-counter-ft-uns-default-rtdb.europe-west1.firebasedatabase.app",
  projectId: "sistem-parking-counter-ft-uns",
  storageBucket: "sistem-parking-counter-ft-uns.appspot.com",
  messagingSenderId: "241040355568",
  appId: "1:241040355568:web:e8d17590c58959cc6e5235",
  measurementId: "G-R4RPDV3ZTC"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);