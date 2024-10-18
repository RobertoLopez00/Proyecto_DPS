import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, StyleSheet, Image, Modal } from 'react-native';
import { Link, useRouter } from 'expo-router';
import axios from 'axios';
import useStore from '@/components/useStore';

const LoginScreen = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [errors, setErrors] = useState({ email: '', password: '' });
  const router = useRouter();

  const setUser = useStore((state) => state.setUser);

  const handleSignIn = () => {

    axios.post('http://192.168.0.33:8000/api/tienda/login', {
      email: email,
      password: password,
    }
    ).then((response) => {
      console.log(response);
      setUser(response.data.usuario);
      console.log('Usuario logueado:', response.data.usuario);
      router.navigate('/(tabs)/home');
    }).catch((error) => {
      console.log(error);
      setEmail('');
      setPassword('');
      router.navigate('/(login)/signIn');
    });
  };

  const validateInputs = () => {
    let emailError = '';
    let passwordError = '';

    // Email validation using regex
    const emailRegex = /\S+@\S+\.\S+/;
    if (!email.trim()) {
      emailError = 'Email is required';
    } else if (!emailRegex.test(email)) {
      emailError = 'Invalid email format';
    }

    // Password validation (simple length check)
    const passwordRegex = /^(?=.*[A-Z])(?=.*[^a-zA-Z]).{6,}$/;
    if (!password.trim()) {
      passwordError = 'Password is required';
    } else if (!passwordRegex.test(password)) {
      passwordError = 'Password must contain at least one uppercase letter and one non-letter character';
    }

    // Set errors
    setErrors({ email: emailError, password: passwordError });

    // If no errors, proceed to login
    if (!emailError && !passwordError) {
      alert('Logging in...');
      router.replace('/(tabs)/home');
    }
  };

  return (
    <View style={styles.container}>
      {/* Logo */}
      <Image
        source={require('../../assets/images/Logotipo-UDB-Tech-shop.png')} // replace with your logo path
        style={styles.logo}
      />

      <Text style={styles.title}>Log in</Text>
      <Text style={styles.subtitle}>Enter your e-mail and password</Text>

      {/* Input de correo electrónico */}
      <TextInput
        style={styles.input}
        placeholder="e-mail"
        keyboardType="email-address"
        value={email}
        onChangeText={setEmail}
        placeholderTextColor="#999"
      />
      {errors.email ? <Text style={styles.errorText}>{errors.email}</Text> : null}

      {/* Input de contraseña */}
      <View style={styles.passwordContainer}>
        <TextInput
          style={styles.input}
          placeholder="Password"
          secureTextEntry={!showPassword}
          value={password}
          onChangeText={setPassword}
          placeholderTextColor="#999"
        />
        <TouchableOpacity onPress={() => setShowPassword(!showPassword)}>
          <Text style={styles.showPassword}>
            {showPassword ? 'Hide' : 'Show'}
          </Text>
        </TouchableOpacity>
      </View>
      {errors.password ? <Text style={styles.errorText}>{errors.password}</Text> : null}

      {/* Forgot password */}
      <TouchableOpacity>
        <Text style={styles.forgotPassword}>Forgot password?</Text>
      </TouchableOpacity>

      {/* Botón de inicio de sesión */}
      <TouchableOpacity style={styles.loginButton} onPress={handleSignIn}>
        <Text style={styles.loginButtonText}>Log in</Text>
      </TouchableOpacity>


      {/* Registro */}
      <View style={styles.signUpContainer}>
        <Text>Don't have an account? </Text>
        <Link href="/(login)/signUp" asChild>
          <TouchableOpacity>
            <Text style={styles.signUpText}>Sign up</Text>
          </TouchableOpacity>
        </Link>
      </View>
      
    </View>
  );
};
const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f0f0f0', // Cambiado de #fff a #f0f0f0
    justifyContent: 'center',
    padding: 20,
  },
  logo: {
    width: 150,
    height: 150,
    resizeMode: 'contain',
    alignSelf: 'center',
    marginBottom: 20,
  },
  title: {
    fontSize: 28, // Aumentado de 24 a 28
    fontWeight: 'bold',
    textAlign: 'center',
    marginBottom: 10,
    color: '#333', // Añadido color
  },
  subtitle: {
    fontSize: 18, // Aumentado de 16 a 18
    color: '#666', // Cambiado de #999 a #666
    textAlign: 'center',
    marginBottom: 20,
  },
  input: {
    borderWidth: 1,
    borderColor: '#ccc', // Cambiado de #ddd a #ccc
    borderRadius: 8, // Cambiado de 10 a 8
    padding: 15,
    marginBottom: 10,
    backgroundColor: '#fff', // Añadido color de fondo
  },
  passwordContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    borderWidth: 1,
    borderColor: '#ccc', // Cambiado de #ddd a #ccc
    borderRadius: 8, // Cambiado de 10 a 8
    padding: 15,
    marginBottom: 10,
    backgroundColor: '#fff', // Añadido color de fondo
  },
  showPassword: {
    color: '#007AFF',
  },
  forgotPassword: {
    color: '#007AFF',
    textAlign: 'right',
    marginBottom: 20,
  },
  loginButton: {
    backgroundColor: '#007AFF', // Cambiado de #DB4444 a #007AFF
    borderRadius: 8, // Cambiado de 10 a 8
    padding: 15,
    alignItems: 'center',
    marginBottom: 20,
  },
  loginButtonText: {
    color: '#fff',
    fontSize: 18, // Aumentado de 16 a 18
    fontWeight: 'bold',
  },
  signUpContainer: {
    flexDirection: 'row',
    justifyContent: 'center',
    alignItems: 'center',
  },
  signUpText: {
    color: '#007AFF', // Cambiado de #DB4444 a #007AFF
    fontWeight: 'bold',
  },
  errorText: {
    color: 'red',
    marginBottom: 10,
  },
});

export default LoginScreen;
