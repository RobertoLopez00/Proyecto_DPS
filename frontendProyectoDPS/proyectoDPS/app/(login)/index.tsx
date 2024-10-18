import { Link, router } from 'expo-router';
import React, {useState} from 'react';
import { View, Text, Image, TouchableOpacity, StyleSheet, Pressable } from 'react-native';
import { StatusBar } from 'expo-status-bar';
import axios from 'axios';


const PrincipalLogin= () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  return (
    <View style={styles.container}>
      <StatusBar style="dark" />
      {/* Logo */}
      <Image
        source={require('../../assets/images/Logotipo-UDB-Tech-shop.png')} // replace with your logo path
        style={styles.logo}
      />
      
      {/* Welcome Text */}
      <Text style={styles.welcomeText}>Welcome to our store</Text>
      
      {/* Sign In Button */}
      <Link href="/(login)/signIn" asChild>
        <TouchableOpacity style={styles.button}>
          <Text style={styles.buttonText}>Sign in</Text>
        </TouchableOpacity>
      </Link>
      
      {/* Get Started Button */}
      <Link href="/(login)/getStarted" asChild>
        <TouchableOpacity style={styles.button}>
            <Text style={styles.buttonText}>Get started</Text>
        </TouchableOpacity>
      </Link>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#fff',
  },
  logo: {
    width: 100, // adjust as needed
    height: 100, // adjust as needed
    marginBottom: 40,
  },
  welcomeText: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 40,
    textAlign: 'center',
  },
  button: {
    backgroundColor: '#DB4444', // red color
    paddingVertical: 15,
    paddingHorizontal: 40,
    borderRadius: 30,
    marginBottom: 20,
    width: '80%',
    alignItems: 'center',
    borderWidth: 1,
    borderColor: '#DB4444',
  },
  buttonText: {
    color: '#fff',
    fontSize: 18,
    fontWeight: 'bold',
  },
});

export default PrincipalLogin;
