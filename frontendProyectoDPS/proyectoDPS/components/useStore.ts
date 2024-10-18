import { create } from 'zustand';
import AsyncStorage from '@react-native-async-storage/async-storage';

const useStore = create((set) => ({
    // Items
    items: [],
    addItem: (item) => set((state) => ({ items: [...state.items, item] })),
    setItems: (items) => set({ items }),
    removeItems: () => set({ items: [] }),

    // Cart
    cartItems: [],
    addCartItem: (item) => set((state) => {
        const existingItem = state.cartItems.find((cartItem) => cartItem.id === item.id);
        if (existingItem) {
            return {
                cartItems: state.cartItems.map((cartItem) =>
                    cartItem.id === item.id ? { ...cartItem, quantity: cartItem.quantity + item.quantity } : cartItem
                ),
            };
        } else {
            return { cartItems: [...state.cartItems, item] };
        }
    }),
    setCartItems: (items) => set({ cartItems: items }),
    removeCartItems: () => set({ cartItems: [] }),
    removeCartItem: (id) => set((state) => ({ cartItems: state.cartItems.filter((item) => item.id !== id) })),
    incrementCartItemByOne: (id) => set((state) => ({
        cartItems: state.cartItems.map((item) =>
            item.id === id ? { ...item, quantity: item.quantity + 1 } : item
        )
    })),
    decrementCartItemByOne: (id) => set((state) => ({
        cartItems: state.cartItems.map((item) =>
            item.id === id ? { ...item, quantity: item.quantity - 1 } : item
        )
    })),

    // Favourites
    favouriteItems: [],
    addFavouriteItem: (item) => set((state) => ({ favouriteItems: [...state.favouriteItems, item] })),
    setFavouriteItems: (items) => set({ favouriteItems: items }),
    removeFavouriteItems: () => set({ favouriteItems: [] }),
    removeFavouriteItem: (id) => set((state) => ({ favouriteItems: state.favouriteItems.filter((item) => item.id !== id) })),

    // Cart history
    history: [],
    fetchHistory: async () => {
    try {
        const existingHistory = await AsyncStorage.getItem('cartHistory');
        if (existingHistory !== null) {
        set({ history: JSON.parse(existingHistory) });
        }
    } catch (e) {
        console.log('Error getting history:', e);
    }
    },
    addToHistory: async (newCart) => {
    try {
        const existingHistory = await AsyncStorage.getItem('cartHistory');
        let updatedHistory = [];

        if (existingHistory !== null) {
        updatedHistory = JSON.parse(existingHistory);
        }

        updatedHistory.push(newCart);

        await AsyncStorage.setItem('cartHistory', JSON.stringify(updatedHistory));
        set({ history: updatedHistory });
    } catch (e) {
        console.log('Error adding to history:', e);
    }
    },

    //location
    location: null,
    setLocation: (location) => set({ location }),

    //User
    user: null,
    setUser: (user) => set({ user }),
    removeUser: () => set({ user: null }),
}));

export default useStore;