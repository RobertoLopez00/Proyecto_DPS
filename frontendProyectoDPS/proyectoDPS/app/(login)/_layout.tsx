import React, { useState, useEffect } from 'react';
import { Stack } from 'expo-router/stack';
//import SplashScreen from '../../components/LoginScreens/SplashScreen';
//import PrincipalLogin from '../../components/LoginScreens/PrincipalLogin';
//import GetStarted from '../../components/LoginScreens/GetStarted';



export default function StackLayout() {
  return (
    <Stack>
      <Stack.Screen name="index" 
        options={{
          headerShown: false,
          title: 'Principal Login'
        }} />
      <Stack.Screen name="getStarted" 
        options={{
          title: 'Get Started'
        }} />
      <Stack.Screen name="signIn" 
        options={{
          title: 'Sign In'
        }} />
        <Stack.Screen name="signUp" 
        options={{
          title: 'Sign Up'
        }} />
    </Stack>
  );
}
