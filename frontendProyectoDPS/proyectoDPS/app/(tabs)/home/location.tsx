import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, Dimensions, StyleSheet, Image, Platform, KeyboardAvoidingView, Modal, Button, Pressable } from 'react-native';
import DropdownPicker from 'react-native-dropdown-picker';
import { SafeAreaView } from 'react-native-safe-area-context';
import useStore from '@/components/useStore';

const screenHeight = Dimensions.get('window').height;
const screenWidth = Dimensions.get('window').width;

const LocationScreen = () => {
  const [zone, setZone] = useState('');
  const [address, setAddress] = useState('');
  const [open, setOpen] = useState(false);
  const [value, setValue] = useState(null);
  const [items, setItems] = useState([
    { label: 'San Salvador', value: 'San Salvador' },
    { label: 'Ahuachapán', value: 'Ahuachapán' },
    { label: 'Cabañas', value: 'Cabañas' },
    { label: 'Chalatenango', value: 'Chalatenango' },
    { label: 'Cuscatlán', value: 'Cuscatlán' },
    { label: 'La Libertad', value: 'La Libertad' },
    { label: 'La Paz', value: 'La Paz' },
    { label: 'La Unión', value: 'La Unión' },
    { label: 'Morazán', value: 'Morazán' },
    { label: 'San Miguel', value: 'San Miguel' },
    { label: 'Santa Ana', value: 'Santa Ana' },
    { label: 'Sonsonate', value: 'Sonsonate' },
    { label: 'Usulután', value: 'Usulután' },
  ]);

  const handleZoneChange = (item) => {
    setZone(item.label);
    setValue(item.value);
  };

  const setLocation = useStore((state) => state.setLocation);
  const [modalVisible, setModalVisible] = useState(false);
  const [modalMessage, setModalMessage] = useState('');

  const handleConfirm = () => {
    if (!value || !address) {
      setModalMessage('Por favor, llene todos los campos');
      setModalVisible(true);
      return;
    } else {
      setLocation(`${value}, ${address}`);
      setModalMessage(`Ubicación guardada: ${value}, ${address}`);
      setModalVisible(true);
    }
  };

  return (
    <KeyboardAvoidingView
      style={styles.container}
      behavior={Platform.OS === 'ios' ? 'padding' : 'height'}
    >
      <Text style={styles.title}>Ingrese su ubicación</Text>

      <Image
        source={{ uri: 'https://freesvg.org/img/location_icon.png' }}
        style={styles.image}
        resizeMode="contain"
      />

      <View style={styles.inputContainerDropdown}>
        <Text style={styles.label}>Departamento de:</Text>
        <DropdownPicker
          style={{ borderColor: '#ccc' }}
          open={open}
          value={value}
          items={items}
          setOpen={setOpen}
          setValue={setValue}
          setItems={setItems}
          placeholder="Seleccione un departamento"
          onChangeItem={handleZoneChange}
          searchable={true}
          searchPlaceholder="Buscar departamento"
          dropDownContainerStyle={{ backgroundColor: '#fff',
            borderWidth: 1,
            borderColor: '#ccc',
            zIndex: 1000,
            position: 'relative',
            top: 0,
            height: 200,
          }}
        />
      </View>

      <View style={styles.inputContainer}>
        <Text style={styles.label}>Su dirección:</Text>
        <TextInput
          style={styles.input}
          value={address}
          onChangeText={setAddress}
          placeholder="Escriba su dirección"
        />
      </View>

      <TouchableOpacity style={styles.button} onPress={handleConfirm}>
        <Text style={styles.buttonText}>Confirmar</Text>
      </TouchableOpacity>

      {/*Modal*/}
      <Modal
        animationType="slide"
        transparent={true}
        visible={modalVisible}
        onRequestClose={() => {
          setModalVisible(!modalVisible);
        }}
      >
        <View style={styles.centeredView}>
          <View style={styles.modalView}>
            <Text style={styles.modalText}>{modalMessage}</Text>
            <Pressable
              style={styles.button}
              onPress={() => setModalVisible(!modalVisible)}
            >
              <Text style={styles.buttonText}>Cerrar</Text>
            </Pressable>
          </View>
        </View>
      </Modal>

    </KeyboardAvoidingView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 20,
    backgroundColor: '#fff',
  },
  scrollViewContent: {
    flexGrow: 1,
    justifyContent: 'center',
  },
  title: {
    fontSize: 25,
    fontWeight: 'bold',
    marginBottom: 10,
    alignSelf: 'center',
  },
  subtitle: {
    marginBottom: 25,
    fontSize: 20,
  },
  inputContainer: {
    marginBottom: 10,
  },
  label: {
    fontSize: 16,
    marginBottom: 5,
  },
  input: {
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 6,
    padding: 10,
  },
  inputContainerDropdown: {
    marginBottom: 10,
  },
  centeredView: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    marginTop: 22,
  },
  modalView: {
    margin: 20,
    backgroundColor: 'white',
    borderRadius: 20,
    padding: 35,
    alignItems: 'center',
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 4,
    elevation: 5,
  },
  modalText: {
    marginBottom: 15,
    textAlign: 'center',
  },
  button: {
    backgroundColor: 'red',
    padding: 15,
    alignItems: 'center',
    borderRadius: 5,
  },
  buttonText: {
    color: '#fff',
    fontWeight: 'bold',
  },
  image: {
    width: '100%',
    height: screenHeight * 0.2,
  },
  titleContainer: {
    alignItems: 'center',
  },
});

export default LocationScreen;

//Esta es la ultima estable