import React, { useEffect, useState } from 'react';
import { 
  View, 
  Text, 
  StyleSheet, 
  TextInput, 
  Image, 
  ActivityIndicator, 
  ScrollView,
  Pressable,
  Dimensions,
} from 'react-native';
import FontAwesome6 from '@expo/vector-icons/FontAwesome6';
import { useFonts } from 'expo-font';
import { SafeAreaProvider, SafeAreaView } from 'react-native-safe-area-context';
import { StatusBar } from 'expo-status-bar';

import imagenEjemplo from '../../../assets/images/home1.jpg';
import { Link } from 'expo-router';
import {
  QueryClient,
  QueryClientProvider,
  useQuery,
} from '@tanstack/react-query';
import useStore from '@/components/useStore';



const screenWidth = Dimensions.get('window').width;
const screenHeight = Dimensions.get('window').height;

const API_URL = 'http://192.168.0.33:8000/api/productos/get';

// Solicitud de datos
function useData(setLoading: (loading: boolean) => void) {
  const { isLoading, error, data } = useQuery({
    queryKey: ['products'],
    queryFn: () =>
      fetch(API_URL).then((res) => {
        if (!res.ok) {
          throw new Error('Network response was not ok');
        }
        return res.json();
      }),
      staleTime: 0,
  });

  useEffect(() => {
    if (!isLoading && !error) {
      setLoading(false);
      console.log(data);
    }else if (error){
      console.error("Error al cargar los datos", error);
    }
  }, [isLoading, error]);

  return { isLoading, error, data };
}

interface ElementProps {
  id: number,
  image: string,
  text: string,
  descuento: string,
  originalPrice: string,
  description: string,
}

function getOfferPrice(price: string, discount: string) {
  const originalPrice = Number.parseFloat(price);
  const discountPrice = Number.parseFloat(discount);
  return (originalPrice - discountPrice).toFixed(2);
}


function Element ({ id, image, text, descuento, originalPrice, description  }: ElementProps) {
  
  const price = getOfferPrice(originalPrice, descuento);

  return(
    <Link href={{
      pathname: "/home/productScreen",
      params: { 
        id: id,
        imageUrl: image, 
        name: text, 
        price: price, 
        description: description
      },
    }} asChild>
      <Pressable style={styles.offer}>
        <Image
          style={styles.offerImage}
          source={{ uri: image }}
        />
        <Text style={styles.offerText}>{text}</Text>
        <View style={{flexDirection: 'row', alignSelf: 'flex-start'}}>
          <Text style={styles.offerPrice}>${price}</Text>
          <Text style={styles.originalPrice}>${originalPrice}</Text>
        </View>
        <View style={styles.stars}>
        </View>
      </Pressable>
    </Link>
  );
}

function App() {
  const location = useStore((state) => state.location);
  const [loading, setLoading] = useState(true);
  const items = useStore((state) => state.items);
  const [fontsLoaded] = useFonts({
    'Poppins-Regular': require('../../../assets/fonts/Poppins-Regular.ttf'),
  });

  const { isLoading, error, data } = useData(setLoading);

  useEffect(() => {
    if (data?.productos && items.length === 0) {
      useStore.setState({ items: data.productos });
      console.log('Datos almacenados en Zustand:', data.productos);
    }
  }, [data, items.length]);

  if (!fontsLoaded || loading || isLoading) {
    return (
      <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
        <ActivityIndicator size="large" color="#0000ff" />
      </View>
    );
  }


  return (
    <SafeAreaProvider>
      <SafeAreaView style={{ flex: 1 }}>
        <ScrollView contentContainerStyle={{alignItems: 'center'}}>
          <StatusBar style="dark" />
          {/* Localizacion */}
          <View style={styles.homeTitle}>
            <Image
              source={require('../../../assets/images/Logotipo-UDB-Tech-shop.png')} // replace with your logo path
              style={styles.logo}
            />
          </View>
          <View style={styles.containerLocation}>
            <Link href="/home/location" asChild>
              <Pressable style={styles.location}>
                <FontAwesome6 name="location-dot" size={24} color="black" />
                <Text style={styles.locationText}>{location || 'Ingrese su ubicacion'}</Text>
              </Pressable>
            </Link>
          </View>
    
          {/* image */}
          <View style={styles.containerImage}>
            <Image
              style={{width: '100%', height: '100%', borderRadius: 10}}
              source={require('../../../assets/images/home1.jpg')}
              />
          </View>
    
          {/* line */}
          <View style={styles.line} />
    
          {/* Offers */}
          <View style={styles.containerOffers}>
            <View style={styles.headerOffers}>
              <View style={styles.headerSquare} />
              <Text style={styles.headerText}>Ofertas</Text>
            </View>
            <Text style={styles.offersTitle}>Ultimas ofertas</Text>
            <View style={styles.containerOffersElements}>
              <Element id={items[0].id} image={items[0].imagen} text={items[0].producto} descuento={items[0].descuento} originalPrice={items[0].precio} description={items[0].descripcion} />
              <Element id={items[1].id} image={items[1].imagen} text={items[1].producto} descuento={items[1].descuento} originalPrice={items[1].precio} description={items[1].descripcion} />
              <Element id={items[2].id} image={items[2].imagen} text={items[2].producto} descuento={items[2].descuento} originalPrice={items[2].precio} description={items[2].descripcion} />
              <Element id={items[7].id} image={items[7].imagen} text={items[7].producto} descuento={items[7].descuento} originalPrice={items[7].precio} description={items[7].descripcion} />
            </View>
          </View>
          {/* line */}
          <View style={styles.line} />
    
          {/* New products */}
          <View style={styles.containerOffers}>
            <View style={styles.headerOffers}>
              <View style={styles.headerSquare} />
              <Text style={styles.headerText}>Nuevo</Text>
            </View>
            <Text style={styles.offersTitle}>Recien llegado</Text>
            <View style={styles.containerNewProducts}>
              <Link href={{
                pathname: "/home/productScreen",
                params: { 
                  id: items[3].id,
                  imageUrl: items[3].imagen, 
                  name: items[3].producto, 
                  price: getOfferPrice(items[3].precio, items[3].descuento),
                  description: items[3].descripcion,
                },
              }} asChild>
                <Pressable style={styles.containerMainNewProducts}>
                  <View style={styles.containerMainNewProductsText}>
                    <Text style={{ color: 'white', fontFamily: 'Poppins-Regular', fontSize: 18, width: '90%' }}>Playstation 5</Text>
                    <Text style={{ color: 'white', fontFamily: 'Poppins-Regular', fontSize: 12, textShadowColor: 'black', textShadowRadius: 15, width: '60%'  }}>Black and white version of PS5 coming out on sale.</Text>
                    <Text style={{ color: 'white', fontFamily: 'Poppins-Regular', fontSize: 14, textDecorationLine: 'underline', width: '90%'  }}>Buy now</Text>
                  </View>
                  <Image
                    source={require('../../../assets/images/ps5.png')}
                    style={{ aspectRatio: 1, minHeight:250, minWidth:250, width: screenHeight * 0.3, height: screenHeight * 0.3, position: 'absolute', right: 5, bottom: 30}}
                  />
                </Pressable>
              </Link>
              <View style={styles.secondaryPanel}>
                <Link href={{
                  pathname: "/home/productScreen",
                  params: { 
                    id: items[4].id,
                    imageUrl: items[4].imagen, 
                    name: items[4].producto, 
                    price: getOfferPrice(items[4].precio, items[4].descuento),
                    description: items[4].descripcion,
                  },
                }} asChild>
                  <Pressable style={styles.containerMain2NewProducts}>
                    <View style={styles.containerMainNewProductsText2}>
                      <Text style={{ color: 'white', fontFamily: 'Poppins-Regular', fontSize: 18, textAlign: 'right', width: '40%', alignSelf: 'flex-end'}}>LED 4K Monitors</Text>
                      <Text style={{ color: 'white', fontFamily: 'Poppins-Regular', fontSize: 12, textAlign: 'right', width: '50%', alignSelf: 'flex-end', textShadowColor: 'black', textShadowRadius: 15, }}>Most advanced technologies</Text>
                      <Text style={{ color: 'white', fontFamily: 'Poppins-Regular', fontSize: 14, textAlign: 'right', width: '90%', alignSelf: 'flex-end', textDecorationLine: 'underline' }}>Buy now</Text>
                    </View>
                    <Image
                      source={require('../../../assets/images/monitor.png')}
                      style={{ width: 170, height: 150, position: 'absolute', left: 20, bottom: 20,}}
                    />
                  </Pressable>
                </Link>
                <View style={styles.containerSecondaryNewProducts}>
                  <Link href={{
                    pathname: "/home/productScreen",
                    params: { 
                      id: items[5].id,
                      imageUrl: items[5].imagen, 
                      name: items[5].producto, 
                      price: getOfferPrice(items[5].precio, items[5].descuento),
                      description: items[5].descripcion,
                    },
                  }} asChild>
                    <Pressable style={styles.containerSecondaryProduct}>
                      <View style={styles.containerMainSecondaryProductsText}>
                        <Text style={{ color: 'white', fontFamily: 'Poppins-Regular', fontSize: 18, textAlign: 'right', width: '90%', alignSelf: 'flex-end'}}>Speakers</Text>
                        <Text style={{ color: 'white', fontFamily: 'Poppins-Regular', fontSize: 12, textAlign: 'right', width: '90%', alignSelf: 'flex-end', textShadowColor: 'black', textShadowRadius: 15 }}>Amazon wireless speakers</Text>
                      </View>
                      <Image
                        source={require('../../../assets/images/amazonSpeaker.png')}
                        style={{ width: 100, height: 120, position: 'absolute', left: 0, bottom: 10,}}
                      />
                    </Pressable>
                  </Link>
                  <Link href={{
                    pathname: "/home/productScreen",
                    params: { 
                      id: items[6].id,
                      imageUrl: items[6].imagen, 
                      name: items[6].producto, 
                      price: getOfferPrice(items[6].precio, items[6].descuento),
                      description: items[6].descripcion,
                    },
                  }} asChild>
                    <Pressable style={styles.containerSecondaryProduct}>
                      <View style={styles.containerMainSecondaryProductsText}>
                        <Text style={{ color: 'white', fontFamily: 'Poppins-Regular', fontSize: 18, textAlign: 'right', width: '90%', alignSelf: 'flex-end'}}>Mouse</Text>
                        <Text style={{ color: 'white', fontFamily: 'Poppins-Regular', fontSize: 12, textAlign: 'right', width: '90%', alignSelf: 'flex-end', textShadowColor: 'black', textShadowRadius: 15 }}>Wired hp mouse HP 100</Text>
                      </View>
                      <Image
                        source={require('../../../assets/images/hp100.png')}
                        style={{ width: 110, height: 100, position: 'absolute', left: 10, bottom: 30,}}
                      />
                    </Pressable>
                  </Link>
                </View>
              </View>
            </View>
          </View>

          {/* line */}
          <View style={styles.line} />

          {/* Benefits */}
          <View style={styles.containerBenefits}>
            <View style={styles.benefit}>
              <View style={styles.exteriorCircle}>
                <View style={styles.interiorCircle}>
                  <FontAwesome6 name="truck" size={36} color="white" />
                </View>
              </View>
              <Text style={styles.benefitText}>Amplia Cobertura</Text>
              <Text style={styles.benefitSecondaryText}>Envio gratis en ordenes mayores a $100</Text>
            </View>
            <View style={styles.benefit}>
              <View style={styles.exteriorCircle}>
                <View style={styles.interiorCircle}>
                  <FontAwesome6 name="headset" size={36} color="white" />
                </View>
              </View>
              <Text style={styles.benefitText}>Asistencia 24/7</Text>
              <Text style={styles.benefitSecondaryText}>Soporte y asistencia amigable 24/7</Text>
            </View>
            <View style={styles.benefit}>
              <View style={styles.exteriorCircle}>
                <View style={styles.interiorCircle}>
                  <FontAwesome6 name="shield-halved" size={36} color="white" />
                </View>
              </View>
              <Text style={styles.benefitText}>Devoluciones</Text>
              <Text style={styles.benefitSecondaryText}>Las devoluciones se hacen efectivas en 30 dias</Text>
            </View>
          </View>
        </ScrollView>
      </SafeAreaView>
    </SafeAreaProvider>

  );
}

export default function Tab() {

  const queryClient = new QueryClient();
  
  return (
    <QueryClientProvider client={queryClient}>
      <App />
    </QueryClientProvider>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1
  },
  homeTitle: {
    justifyContent: 'center',
    alignItems: 'flex-start',
    paddingLeft: 20,
    height: 64,
    width: '100%',
    backgroundColor: 'white',
    borderBottomWidth: 1,
    borderBottomColor: 'lightgrey',
  },
  logo: {
    width: 60, // adjust as needed
    height: 60, // adjust as needed
  },
  containerLocation: {
    marginTop: 10,
    justifyContent: 'center',
    alignItems: 'center',
    height: 60,
  },
  location: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  locationText: {
    fontSize: 16,
    marginLeft: 10,
    fontFamily: 'Poppins-Regular',
    paddingTop: 2,
  },
  containerSearch: { 
    justifyContent: 'center',
    alignItems: 'center',
    height: 50,
  },
  search: {
    flexDirection: 'row',
    height: 50,
    backgroundColor: 'lightgrey',
    width: 300,
    borderRadius: 10,
    alignItems: 'center',
    justifyContent: 'space-around',
  },
  searchInput: {
    height: 40,
    backgroundColor: 'lightgrey',
    width: 200,
    borderRadius: 10,
    marginLeft: -30,
    fontFamily: 'Poppins-Regular',
    paddingTop: 2,
  },
  containerImage: {
    marginTop: 10,
    justifyContent: 'center',
    alignItems: 'center',
    height: screenHeight * 0.2,
    maxHeight: 250,
    minHeight: 150,
    overflow: 'hidden',
    maxWidth: 950,
    width: '90%',
  },
  line: {
    borderBottomColor: 'lightgrey',
    borderBottomWidth: 1,
    width: '90%',
    marginTop: 20,
    marginBottom: 8,
  },
  containerOffers: {
    width: '90%',
    alignItems: 'center',
  },
  headerOffers: {
    flexDirection: 'row',
    alignItems: 'center',
    alignSelf: 'flex-start',
    height: 70,
  },
  headerSquare: {
    width: 35,
    height: 50,
    backgroundColor: 'black',
    marginLeft: 8,
    borderRadius: 8,
  },
  headerText: {
    fontSize: 16,
    marginLeft: 10,
    fontFamily: 'Poppins-Regular',
    fontWeight: 'bold',
  },
  offersTitle: {
    fontSize: 22,
    fontFamily: 'Poppins-Regular',
    fontWeight: 'bold',
    alignSelf: 'flex-start',
    marginLeft: 8,
  },
  containerOffersElements: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'space-around',
    width: '100%',
  },
  offer: {
    width: '32%',
    height: screenHeight * 0.3,
    minHeight: 200,
    minWidth: 160,
    maxWidth: 350,
    marginTop: 10,
    alignItems: 'center',
    position: 'relative',
    borderWidth: 1,
    borderColor: 'lightgrey', 
    borderRadius: 10,
  },
  offerImage: {
    width: '100%',
    height: '70%',
    minHeight: 120,
    minWidth: 150,
    aspectRatio: '120/150',
    borderRadius: 10,
    marginTop: 5,
    resizeMode: 'contain',
  },
  icons: {
    position: 'absolute',
    width: screenWidth * 0.08,
    height: screenHeight * 0.09,
    flexDirection: 'column',
    top: '5%',
    right: '5%',
    alignItems: 'flex-end',
    justifyContent: 'space-between',
  },
  favourites: {
    width: screenHeight * 0.04,
    height: screenHeight * 0.04,
    borderRadius: 90,
    backgroundColor: 'white',
    alignItems: 'center',
    justifyContent: 'center',
  },
  seen: {
    width: screenHeight * 0.04,
    height: screenHeight * 0.04,
    borderRadius: 90,
    backgroundColor: 'white',
    alignItems: 'center',
    justifyContent: 'center',
    marginTop: 5,
  },
  offerText: {
    fontSize: 12,
    fontFamily: 'Poppins-Regular',
    alignSelf: 'flex-start',
    marginTop: 5,
    marginLeft: 10,
    height: 20,
  },
  offerPrice: {
    fontSize: 14,
    fontFamily: 'Poppins-Regular',
    fontWeight: 'bold',
    alignSelf: 'flex-start',
    marginLeft: 10,
    color: '#DB4444',
    height: 20,
  },
  
  originalPrice: {
    fontSize: 14,
    fontFamily: 'Poppins-Regular',
    fontWeight: 'bold',
    alignSelf: 'flex-start',
    marginLeft: 10,
    color: 'grey',
    height: 20,
    textDecorationLine: 'line-through',
  },
  stars: {
  },
  containerNewProducts: {
    width: '95%',
    flexWrap: 'wrap',
    justifyContent: 'space-around',
    flexDirection: 'row',
    marginTop: 20,
    marginBottom: 20,
    maxWidth: 950,

  },
  secondaryPanel: {
    width: '100%',
    maxWidth: 450,
    flexDirection: 'column',
    justifyContent: 'space-between',
    marginTop: 0,
    maxHeight: 400,
  },
  containerMainNewProducts: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    width: '100%',
    maxWidth: 450,
    maxHeight: 400,
    height: screenHeight * 0.5,
    backgroundColor: 'black',
    position: 'relative',
    marginBottom: 20,
  },
  containerMainNewProductsText: {
    justifyContent: 'center',
    alignSelf: 'flex-start',
    width: '100%',
    height: screenHeight * 0.25,
    marginBottom: 10,
    paddingLeft: 10,
    zIndex: 6,
  },
  containerMain2NewProducts: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    width: '100%',
    maxWidth: 450,
    maxHeight: 190,
    height: screenHeight * 0.25,
    backgroundColor: 'black',
    position: 'relative',
    marginBottom: 20,
  },
  containerMainNewProductsText2: {
    justifyContent: 'center',
    alignSelf: 'flex-start',
    width: '100%',
    height: '100%',
    paddingRight: 10,
    zIndex: 6,
  },
  containerSecondaryNewProducts: {
    flexDirection: 'row',
    width: '100%',
    maxWidth: 450,
    justifyContent: 'space-between',
  },
  containerSecondaryProduct: {
    width: '48%',
    maxHeight: 190,
    maxWidth: 220,
    height: screenHeight * 0.25,
    backgroundColor: 'black',
  },
  containerMainSecondaryProductsText: {
    alignSelf: 'flex-start',
    width: '100%',
    height: screenHeight * 0.25,
    paddingRight: 10,
    zIndex: 6,
  },
  containerBenefits: {
    width: '90%',
    alignItems: 'center',
    marginTop: 20,

  },
  benefit: {
    width: '100%',
    flexDirection: 'column',
    justifyContent: 'space-around',
    alignItems: 'center',
    marginBottom: 20,
  },
  exteriorCircle: {
    width: 100,
    height: 100,
    borderRadius: 100,
    backgroundColor: 'lightgrey',
    alignItems: 'center',
    justifyContent: 'center',
  },
  interiorCircle: {
    width: 80,
    height: 80,
    borderRadius: 100,
    backgroundColor: 'black',
    alignItems: 'center',
    justifyContent: 'center',
  },
  benefitText: {
    marginTop: 10,
    fontSize: 20,
    fontFamily: 'Poppins-Regular',
    fontWeight: 'bold',
  },
  benefitSecondaryText: {
    fontSize: 12,
    fontFamily: 'Poppins-Regular',
    color: 'grey',
  },
});
