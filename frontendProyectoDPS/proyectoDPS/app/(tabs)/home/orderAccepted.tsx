import React, { useRef, useEffect } from 'react';
import { View, Text, StyleSheet, Image, TouchableOpacity, Animated } from 'react-native';

const OrderAcceptedScreen = () => {
  const scaleAnim = useRef(new Animated.Value(0)).current;

  useEffect(() => {
    Animated.spring(scaleAnim, {
      toValue: 1,
      duration: 1000,
      useNativeDriver: true,
    }).start();
  }, [scaleAnim]);

  return (
    <View style={styles.container}>
      <Animated.Image
        source={require('../../../assets/images/greencheckmark.png')}
        style={[styles.checkMark, { transform: [{ scale: scaleAnim }] }]}
      />
      <Text style={styles.title}>Su orden ha sido aceptada</Text>
      <Text style={styles.description}>
        ¡La orden llegará a su puerta lo más rápido posible!
      </Text>
      <TouchableOpacity style={styles.button}>
        <Text style={styles.buttonText}>Rastrear Orden</Text>
      </TouchableOpacity>
      <TouchableOpacity style={styles.buttonback}>
        <Text style={styles.buttonText}>Regresar</Text>
      </TouchableOpacity>
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
  checkMark: {
    width: 175,
    height: 175,
    marginBottom: 25,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 10,
  },
  description: {
    fontSize: 16,
    textAlign: 'center',
    marginBottom: 20,
  },
  button: {
    backgroundColor: '#f44336',
    padding: 15,
    borderRadius: 5,
    width: '80%',
    marginBottom: 10,
  },
  buttonback: {
    backgroundColor: '#f44336',
    padding: 15,
    borderRadius: 5,
    width: '40%',
    marginBottom: 10,
  },
  buttonText: {
    color: '#fff',
    textAlign: 'center',
    fontSize: 18,
  },
});

export default OrderAcceptedScreen;
