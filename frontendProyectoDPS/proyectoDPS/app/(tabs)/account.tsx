import React, { useState, useEffect } from 'react';
import { View, Text, StyleSheet, TouchableOpacity, FlatList, Pressable, Modal } from 'react-native';
import FontAwesome6 from '@expo/vector-icons/FontAwesome6';
import FontAwesome from '@expo/vector-icons/FontAwesome';
import useStore from '@/components/useStore';
import { router } from 'expo-router';

import { auth } from '../../firebaseConfig';
import { signOut } from 'firebase/auth';
import AsyncStorage from '@react-native-async-storage/async-storage';
interface AccountSettingProps {
  icon: string,
  text: string,
}

const AccountSetting = ({ icon, text }: AccountSettingProps) => {
  return (
    <View style={styles.accountSetting}>
      <View style={styles.leftContent}>
        <View style={styles.icon}>
        <FontAwesome6 name={icon} size={24} color="black" />
        </View>
        <Text style={styles.bodyText}>{text}</Text>
      </View>
      <View style={styles.rightContent}>
        <FontAwesome6 name="angle-right" size={24} color="black" />
      </View>
    </View>
  );
}

export default function Tab() {
  const [isModalVisible, setModalVisible] = useState(false);
  const history = useStore((state) => state.history);
  const fetchHistory = useStore((state) => state.fetchHistory);
  const user = useStore((state) => state.user);
  const removeUser = useStore((state) => state.removeUser);

  useEffect(() => {
    fetchHistory();
  }, [fetchHistory]);

  const toggleModal = () => {
    setModalVisible(!isModalVisible);
  };

  return (
    <View style={styles.container}>
      <View style={styles.header}>
        <View style={styles.profilePic}>
          <FontAwesome name="user-circle-o" size={50} color="black" />
        </View>
        <View style={styles.containerHeaderText}>
          <Text style={styles.Name}>{user.nombres} {user.apellidos}</Text>
          <Text style={styles.Email}>{user.email}</Text>
        </View>
      </View>
      <View style={styles.containerBody}>
        <Pressable onPress={toggleModal}>
          <AccountSetting icon="truck-ramp-box" text="My orders" />
        </Pressable>
        <Modal 
          visible={isModalVisible}
          transparent={true}
          animationType='slide'
          onRequestClose={toggleModal}
        >
          <View style={styles.modalContent}>
            <Text style={styles.modalTitle}>Order History</Text>
            <FlatList
              data={history}
              style={{ width: '100%' }}
              keyExtractor={(item) => item.id.toString()}
              renderItem={({ item }) => (
                <View style={styles.cartItem}>
                  <Text style={styles.cartItemDate}>Date: {new Date(item.date).toLocaleString()}</Text>
                  {item.items.map((cartItem) => (
                    <View key={cartItem.id} style={styles.cartItemDetail}>
                      <Text style={styles.cartItemName}>{cartItem.name}</Text>
                      <Text style={styles.cartItemPrice}>${cartItem.price}</Text>
                      <Text style={styles.cartItemQuantity}>Quantity: {cartItem.quantity}</Text>
                      <Text style={styles.cartItemQuantity}>Total: ${(Number.parseFloat(cartItem.price) * cartItem.quantity).toFixed(2)}</Text>
                    </View>
                  ))}
                  <Text style={styles.cartItemTotalPrice}>Total: ${item.total.toFixed(2)}</Text>
                </View>
              )}
            />
            <Pressable onPress={toggleModal} style={styles.closeButton}>
              <Text style={styles.closeButtonText}>Close</Text>
            </Pressable>
          </View>
        </Modal>
        <AccountSetting icon="id-card" text="My details" />
        <AccountSetting icon="location-dot" text="Delivery address" />
        <AccountSetting icon="credit-card" text="Payment methods" />
        <AccountSetting icon="ticket" text="Promo Code" />
        <AccountSetting icon="bell" text="Notifications" />
        <AccountSetting icon="circle-question" text="Help" />
        <AccountSetting icon="circle-info" text="About" />
      </View>
      <TouchableOpacity style={styles.logOutButton} onPress={
        async () => {
          await signOut(auth);
          await AsyncStorage.removeItem("@user");
          console.log('Logged out');
          router.navigate('/(login)');
        }
        
      }>
        <View style={styles.iconSignOut}>
          <FontAwesome name="sign-out" size={24} color="white" />
        </View>
        <Text style={styles.logOutButtonText}>Log out</Text>
      </TouchableOpacity>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  header: {
    flexDirection: 'row',
    padding: 20,
    width: '90%',
    justifyContent: 'center',
    borderBottomWidth: 1,
  },
  profilePic: {
    width: 52,
    height: 52,
    justifyContent: 'center',
    alignItems: 'center',
  },
  containerHeaderText: {
    marginLeft: 20,
  },
  Name: {
    fontSize: 20,
    fontWeight: 'bold',
  },
  Email: {
    fontSize: 12,
  },
  containerBody: {
    width: '90%',
  },
  accountSetting: {
    flexDirection: 'row',
    padding: 10,
    borderBottomWidth: 1,
    borderBottomColor: 'gray',
    width: '100%',
    height: 60,
  },
  leftContent: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
  },
  icon: {
    width: 50,
    height: 50,
    alignItems: 'center',
    justifyContent: 'center',
  },
  rightContent: {
    marginLeft: 'auto',
    alignItems: 'center',
    justifyContent: 'center',
  },
  bodyText: {
    marginLeft: 10,
  },
  modalContent: {
    backgroundColor: 'white',
    paddingVertical: 20,
    paddingHorizontal: 5,
    borderRadius: 8,
    alignItems: 'center',
    height: '100%',
  },
  modalTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 16,
  },
  cartItem: {
    padding: 16,
    borderBottomWidth: 1,
    borderBottomColor: '#ddd',
  },
  cartItemDate: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 8,
  },
  cartItemDetail: {
    paddingLeft: 16,
    marginBottom: 8,
  },
  cartItemName: {
    fontSize: 18,
    fontWeight: 'bold',
  },
  cartItemQuantity: {
    fontSize: 16,
  },
  cartItemPrice: {
    fontSize: 16,
  },
  cartItemTotalPrice: {
    fontSize: 20,
    paddingLeft: 16,
    fontWeight: 'bold',
    color: '#DB4444',
  },
  closeButton: {
    backgroundColor: '#DB4444',
    padding: 16,
    borderRadius: 8,
    alignItems: 'center',
    marginTop: 16,
  },
  closeButtonText: {
    color: '#fff',
    fontSize: 18,
  },
  logOutButton: {
    backgroundColor: '#DB4444',
    borderRadius: 100,
    width: '70%',
    marginTop: 20,
    padding: 10,
    alignItems: 'center',
    justifyContent: 'center',
    marginBottom: 20,
    position: 'relative',
    height: 50,
  },
  iconSignOut: {
    position: 'absolute',
    left: 20,
    bottom: 12,
  },
  logOutButtonText: {
    color: '#fff',
    fontSize: 16,
    fontWeight: 'bold',
  },
  
});
