const { getDefaultConfig } = require('@expo/metro-config'); // Si usas Expo
// O usa esto si es React Native CLI
// const { getDefaultConfig } = require('metro-config');

module.exports = (async () => {
  const defaultConfig = await getDefaultConfig(__dirname);
  // Modificaciones de la configuración predeterminada
  defaultConfig.resolver.assetExts.push('cjs'); // Ejemplo: agregar soporte para archivos .cjs
  return defaultConfig;
})();