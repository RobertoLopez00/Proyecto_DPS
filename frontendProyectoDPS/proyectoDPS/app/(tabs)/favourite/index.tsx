import { View, Text, StyleSheet, Image, Pressable, ScrollView, TouchableOpacity, FlatList } from 'react-native';
import FontAwesome6 from '@expo/vector-icons/FontAwesome6';
import FontAwesome from '@expo/vector-icons/FontAwesome';
import useStore from '@/components/useStore';
import { Link } from 'expo-router';


interface FavouriteItemProps {
  item: {
    id: number;
    name: string;
    price: number;
    imageUrl: string;
    description: string,
  };
}



const FavouriteItem = ({ item }: FavouriteItemProps) => {
  return(
    <Link href={{
      pathname: "/favourite/productScreen",
      params: {
        id: item.id,
        imageUrl: item.imageUrl, 
        name: item.name, 
        price: item.price, 
        description: item.description
      },
    }} asChild>
      <Pressable style={styles.favouriteItem}>
        <View style={styles.favouriteItemName}>
          <Text style={styles.favouriteItemNameText}>{item.name}</Text>
        </View>
        <View style={styles.favouriteItemBody}>
          <View style={styles.favouriteItemLeft}>
            <Image style={styles.favouriteItemImage} source={{ uri: item.imageUrl }} />
          </View>
          <View style={styles.favouriteItemRight}>
            <Text style={styles.price}>${item.price}</Text>
            <FontAwesome6 name="angle-right" size={24} color="black" />
          </View>
        </View>
      </Pressable>
    </Link>
  );
}

export default function Tab() {

  const favouriteItems = useStore((state) => state.favouriteItems);

  return (
    <View style={styles.container}>
      <View style={styles.header}>
        <Text style={styles.headerText}>My favourites</Text>
      </View>
      <View style={styles.containerBody}>

        {/* Migrar a flatlist una vez se pueda pedir la solicitud por servidor */}

        <FlatList
          data={favouriteItems}
          keyExtractor={(item) => item.id.toString()}
          renderItem={({ item }) => <FavouriteItem item={item} />}
        />
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
  header: {
    width: '100%',
    flex: 1,
    padding: 20,
    borderBottomWidth: 1,
    borderBottomColor: '#ddd',
    justifyContent: 'center',
  },
  headerText: {
    fontSize: 20,
    fontWeight: 'bold',
    textAlign: 'center',
  },
  containerBody: {
    width: '100%',
    flex: 15,
  },
  favouriteItem: {
    flexDirection: 'column',
    padding: 10,
    borderBottomWidth: 1,
    borderBottomColor: '#ddd',
  },
  favouriteItemName: {
    width: '100%',
    alignItems: 'center',
  },
  favouriteItemNameText: {
    fontSize: 16,
    fontWeight: 'bold',
  },
  favouriteItemBody: {
    flexDirection: 'row',
    width: '100%',
    
    justifyContent: "space-between",
  },
  favouriteItemLeft: {
    width: '60%',
    alignItems: 'center',
    height: '100%',
  },
  favouriteItemImage: {
    width: 120,
    height: 100,
    resizeMode: 'contain',
  },
  btn: {
    padding: 10,
    backgroundColor: '#ddd',
    borderRadius: 5,
  },
  btnPressed: {
    padding: 10,
    backgroundColor: 'darkgray',
    borderRadius: 5,
  },
  quantity: {
    padding: 10,
  },
  favouriteItemRight: {
    width: '40%',
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
  },
  btnTrash: {
    padding: 10,
    alignSelf: 'flex-end',
  },
  price: {
    fontSize: 16,
    fontWeight: 'bold',
  },
  checkout: {
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
  checkoutText: {
    color: '#fff',
    fontSize: 16,
    fontWeight: 'bold',
  },
});
