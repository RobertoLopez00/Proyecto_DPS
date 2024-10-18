import React, { useState, useEffect } from "react";
import { Stack } from "expo-router";
import SplashScreen from "../components/SplashScreen"; // Tu pantalla de carga
import { auth } from "../firebaseConfig"; // Firebase auth si usas firebase
import { Header } from "react-native/Libraries/NewAppScreen";

export default function Layout() {
  const [appIsReady, setAppIsReady] = useState(false);
  const [loggedIn, setLoggedIn] = useState(false);

  // Simular o realizar la carga de recursos
  async function loadResourcesAsync() {
    await new Promise((resolve) => setTimeout(resolve, 2000)); // Simulación de 2 segundos
  }

  useEffect(() => {
    // Cargar recursos y luego marcar como listo
    async function prepareApp() {
      await loadResourcesAsync();
      setAppIsReady(true);
    }

    prepareApp();

    // Si usas Firebase, podrías verificar si el usuario está autenticado
    const unsubscribe = auth.onAuthStateChanged((user) => {
      setLoggedIn(!!user); // Si hay usuario, setea loggedIn a true
    });

    return () => unsubscribe(); // Limpiar la subscripción al cambiar de componente
  }, []);

  // Mostrar la pantalla de carga mientras se prepara la app
  if (!appIsReady) {
    return <SplashScreen />;
  }

  // Mostrar la pantalla de login si el usuario no está autenticado
  if (!loggedIn) {
    return (
      <Stack>
        <Stack.Screen name="(login)" options={{ headerShown: false }} />
        <Stack.Screen name="(tabs)" options={{ headerShown: false }} />
      </Stack>
    );
  }

  // Mostrar la app principal si el usuario está autenticado
  if (loggedIn){
    return (
      <Stack>
        <Stack.Screen name="(login)" options={{ headerShown: false }} />
        <Stack.Screen name="(tabs)" options={{ headerShown: false }} />
      </Stack>
    );
  }
}
