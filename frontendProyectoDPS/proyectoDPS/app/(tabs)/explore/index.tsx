import { View, Text, StyleSheet, Image, ScrollView, Pressable } from 'react-native';
import imageMonitor from '../../../assets/images/monitor.png';
import imagenComputer from '../../../assets/images/computer.png';
import imagenGaming from '../../../assets/images/gaming.png';
import imagenHardware from '../../../assets/images/hardware.png';
import imagenSoftware from '../../../assets/images/software.png';
import imagenMobile from '../../../assets/images/mobile.png';
import imagenPeripherals from '../../../assets/images/peripherals.png';
import { Link } from 'expo-router';

interface CategoryProps {
  name: string;
  image: number;
  id_category: number;
}

const Category = ({ name, image, id_category}: CategoryProps) => {
  return (
    <Link href={{
      pathname: '/explore/products',
      params: { 
        id_category: id_category,
      },
    }} asChild>
      <Pressable style={styles.category}>
        <Image style={styles.categoryImage} source={image} />
        <Text style={styles.categoryText}>{name}</Text>
      </Pressable>
    </Link>
  );
};

export default function Tab() {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Categories</Text>
      <View style={styles.categoriesListContainer}>
          <Category name='Computers' image={imagenComputer} id_category={0} />
          <Category name='Gaming' image={imagenGaming} id_category={1} />
          <Category name='Hardware' image={imagenHardware} id_category={2} />
          <Category name='Software' image={imagenSoftware} id_category={3} />
          <Category name='Mobile' image={imagenMobile} id_category={4} />
          <Category name='Peripherals' image={imagenPeripherals} id_category={5} />
        </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#f0f0f0', // Cambiado de #fff a #f0f0f0
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginVertical: 20, // Aumentado de 10 a 20
    color: '#333', // Añadido color
  },
  categoriesList: {
    width: '90%',
    paddingVertical: 10,
    backgroundColor: '#fff',
    borderRadius: 10, // Añadido borde redondeado
    padding: 10, // Añadido padding
  },
  categoriesListContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    flexWrap: 'wrap',
    width: '100%', // Cambiado de 90% a 100%
  },
  category: {
    alignItems: 'center',
    borderWidth: 1,
    backgroundColor: '#e0f7fa', // Cambiado de #fae3e3 a #e0f7fa
    borderColor: '#00796b', // Cambiado de #DB4444 a #00796b
    borderRadius: 20,
    width: 150,
    marginVertical: 10,
    marginHorizontal: '2%',
    padding: 10,
    height: 170,
    justifyContent: 'center',
  },
  categoryImage: {
    width: 100, // Reducido de 120 a 100
    height: 100, // Reducido de 120 a 100
  },
  categoryText: {
    marginTop: 10,
    fontSize: 16,
    fontWeight: 'bold',
    color: '#00796b', // Añadido color
  },
});
