import React, { useState, useEffect } from 'react';
import { Stack } from 'expo-router/stack';



export default function StackLayout() {
  return (
    <Stack>
      <Stack.Screen name="index" 
        options={{
          headerShown: false,
        }} />
      <Stack.Screen name="productScreen" 
        options={{
          title: 'Product'
        }} />
    </Stack>
  );
}
