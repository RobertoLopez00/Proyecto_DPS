import React, { useState, useEffect } from 'react';
import { View, Text, TouchableOpacity, Image, StyleSheet, ActivityIndicator } from 'react-native';
import { Link, useRouter } from 'expo-router';
import * as WebBrowser from 'expo-web-browser';
import * as Google from 'expo-auth-session/providers/google';
import {
  GoogleAuthProvider,
  onAuthStateChanged,
  signInWithCredential,
} from 'firebase/auth';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { auth } from '../../firebaseConfig';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';

WebBrowser.maybeCompleteAuthSession();

interface getStartedProps {
  promptAsync: () => void;
}

const LoginScreen: React.FC<getStartedProps> = () => {
  // Hooks moved inside the functional component
  const [userInfo, setUserInfo] = useState();
  const [loading, setLoading] = useState(false);
  const router = useRouter();
  const [request, response, promptAsync] = Google.useAuthRequest({
    responseType: 'id_token', 
    androidClientId: '463503113117-7e6ok04llhb5t5djdaqeo21n75dv4har.apps.googleusercontent.com',
    webClientId: '463503113117-hns5csl4i8ejdab576e7pof3qtp5drm0.apps.googleusercontent.com',
  });

  const getLocalUser = async () => {
    try{
      setLoading(true);
      const userJSON = await AsyncStorage.getItem("@user");
      const userData = userJSON ? JSON.parse(userJSON) : null;
      setUserInfo(userData);  
    } catch(e){
      console.log(e, "Error getting local user");
    } finally {
      setLoading(false);
    }
  }

  useEffect(() => {
    if (response?.type === 'success') {
      const { id_token } = response.params;
      const credential = GoogleAuthProvider.credential(id_token);
      signInWithCredential(auth, credential)
      .then((userCredential) => {
        const user = userCredential.user;
        console.log('Logged in with Google: ', user.displayName);
      })
    }
}, [response]);


  useEffect(() => {
    getLocalUser();
    const unSub = onAuthStateChanged(auth, async (user) => {
      if (user){
        await AsyncStorage.setItem("@user", JSON.stringify(user));
        console.log(JSON.stringify(user, null, 2));
        if(loading){
          <View>
            <ActivityIndicator size="large" color="#0000ff" />
          </View>
        }
        router.replace("/(tabs)/home");
      } else {
        console.log('User not authenticated');
      }
  })
  return () => unSub();
  }, []);

  return (
    <View style={styles.container}>
      {/* Texto superior */}
      <Text style={styles.title}>Get every tech supply you need</Text>

      {/* Botón de Crear cuenta */}
      <Link href="/(login)/SignUp" asChild>
        <TouchableOpacity style={styles.createAccountButton}>
          <Text style={styles.createAccountText}>Create an account</Text>
        </TouchableOpacity>
      </Link>

      {/* Texto de conectarse con redes sociales */}
      <Text style={styles.socialText}>Connect with social media</Text>

      {/* Botón de Google */}
      <TouchableOpacity style={styles.googleButton} onPress={() => promptAsync()}>
        <View style={styles.iconTextContainer}>
          <Image
            source={{
              uri: 'https://www.freepnglogos.com/uploads/google-logo-png/google-logo-icon-png-transparent-background-osteopathy-16.png',
            }}
            style={styles.icon}
          />
          <Text style={styles.buttonText}>Continue with Google</Text>
        </View>
      </TouchableOpacity>

      {/* Botón de Facebook */}
      <TouchableOpacity style={styles.facebookButton}>
        <View style={styles.iconTextContainer}>
          <Image
            source={{
              uri: 'https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg',
            }}
            style={styles.icon}
          />
          <Text style={styles.buttonText}>Continue with Facebook</Text>
        </View>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
    backgroundColor: '#fff',
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    textAlign: 'center',
    marginBottom: 30,
    color: '#000',
  },
  createAccountButton: {
    backgroundColor: '#FF4D4D',
    paddingVertical: 15,
    paddingHorizontal: 80,
    borderRadius: 30,
    marginBottom: 20,
  },
  createAccountText: {
    color: '#fff',
    fontSize: 16,
    fontWeight: 'bold',
  },
  socialText: {
    color: '#808080',
    fontSize: 14,
    marginBottom: 20,
  },
  googleButton: {
    backgroundColor: '#FF4D4D',
    flexDirection: 'row',
    alignItems: 'center',
    paddingVertical: 12,
    paddingHorizontal: 40,
    borderRadius: 30,
    marginBottom: 15,
  },
  facebookButton: {
    backgroundColor: '#4267B2',
    flexDirection: 'row',
    alignItems: 'center',
    paddingVertical: 12,
    paddingHorizontal: 40,
    borderRadius: 30,
  },
  iconTextContainer: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  icon: {
    width: 20,
    height: 20,
    marginRight: 10,
  },
  buttonText: {
    color: '#fff',
    fontSize: 16,
    fontWeight: 'bold',
  },
});

export default LoginScreen;
