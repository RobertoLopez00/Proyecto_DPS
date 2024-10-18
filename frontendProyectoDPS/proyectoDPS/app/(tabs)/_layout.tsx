import { Stack, Tabs } from "expo-router";
import FontAwesome6 from '@expo/vector-icons/FontAwesome6';
import { StatusBar } from 'expo-status-bar';

export default function TabLayout() {
  return (
    <>
      <Tabs screenOptions={{ tabBarActiveTintColor: '#DB4444', tabBarInactiveTintColor: '#000000', tabBarHideOnKeyboard: true }}>
        <Tabs.Screen
          name="home"
          options={{
            title: 'Shop',
            headerShown: false,
            tabBarIcon: ({ color }) => <FontAwesome6 size={26} name="store" color={color} />,
          }}
        />
        <Tabs.Screen
          name="explore"
          options={{
            title: 'Explore',
            tabBarIcon: ({ color }) => <FontAwesome6 size={26} name="magnifying-glass" color={color} />,
          }}
        />
        <Tabs.Screen
          name="cart"
          options={{
            title: 'Cart',
            tabBarIcon: ({ color }) => <FontAwesome6 size={26} name="cart-shopping" color={color} />,
          }}
        />
        <Tabs.Screen
          name="favourite"
          options={{
            title: 'Favourite',
            tabBarIcon: ({ color }) => <FontAwesome6 size={28} name="heart" color={color} />,
          }}
        />
        <Tabs.Screen
          name="account"
          options={{
            title: 'Account',
            tabBarIcon: ({ color }) => <FontAwesome6 size={26} name="user" color={color} />,
          }}
        />
      </Tabs>
    </>
  );
}
