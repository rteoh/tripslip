import { createStackNavigator} from 'react-navigation-stack';
import {createAppContainer} from 'react-navigation';
import Home from './Home';
import searchResult from './searchResult';

const AppNavigator = createStackNavigator({
  Home: { screen: Home },
  searchResult: { screen: searchResult},

});
const App=createAppContainer(AppNavigator);

//const DrawerNavigation = StackNavigator({
//  DrawerStack: { screen: DrawerStack }
//}, {
//  headerMode: 'float',
//  navigationOptions: ({navigation}) => ({
//    headerStyle: {backgroundColor: '#4C3E54'},
//    title: 'Welcome!',
//    headerTintColor: 'white',
//  })
//});
//const DrawerStack=DrawerNavigator({
//                                  screen1: {screen:Screen1},
//                                  screen2: {screen:Screen2 },
//                                  });

export default App;
