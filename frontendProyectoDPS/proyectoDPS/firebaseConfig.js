// Android ID: 463503113117-7e6ok04llhb5t5djdaqeo21n75dv4har.apps.googleusercontent.com
// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import {getAuth} from "firebase/auth";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyCLBQs80r-OZybsUfc1D4-I8MIjv6kyR-s",
  authDomain: "sign-in-firebase-4a27d.firebaseapp.com",
  projectId: "sign-in-firebase-4a27d",
  storageBucket: "sign-in-firebase-4a27d.appspot.com",
  messagingSenderId: "1096332032547",
  appId: "1:1096332032547:web:faf98e11f2863e8b234f96"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
export const auth = getAuth(app);