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
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginVertical: 10,
  },
  categoriesList: {
    width: '90%',
    paddingVertical: 10,
    backgroundColor: '#fff',
  },
  categoriesListContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    flexWrap: 'wrap',
    width: '90%',
  },
  category: {
    alignItems: 'center',
    borderWidth: 1,
    backgroundColor: '#fae3e3',
    borderColor: '#DB4444',
    borderRadius: 20,
    width: 150,
    marginVertical: 10,
    marginHorizontal: '2%',
    padding: 10,
    height: 170,
    justifyContent: 'center',
  },
  categoryImage: {
    width: 120,
    height: 120,
  },
  categoryText: {
    marginTop: 10,
    fontSize: 16,
    fontWeight: 'bold',
  },
});
