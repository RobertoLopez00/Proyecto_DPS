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
      <Text style={styles.welcomeText}>Welcome to our newest E-commerce</Text>
      
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
    backgroundColor: '#f0f0f0', // Cambiado de #fff a #f0f0f0
  },
  logo: {
    width: 150, // Ajustado de 100 a 150
    height: 150, // Ajustado de 100 a 150
    marginBottom: 40,
  },
  welcomeText: {
    fontSize: 28, // Aumentado de 24 a 28
    fontWeight: 'bold',
    marginBottom: 40,
    textAlign: 'center',
    color: '#333', // Añadido color
  },
  button: {
    backgroundColor: '#007AFF', // Cambiado de #DB4444 a #007AFF
    paddingVertical: 15,
    paddingHorizontal: 40,
    borderRadius: 8, // Cambiado de 30 a 8
    marginBottom: 20,
    width: '80%',
    alignItems: 'center',
    borderWidth: 1,
    borderColor: '#007AFF', // Cambiado de #DB4444 a #007AFF
  },
  buttonText: {
    color: '#fff',
    fontSize: 18,
    fontWeight: 'bold',
  },
});

export default PrincipalLogin;
