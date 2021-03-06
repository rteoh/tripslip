import { createStackNavigator} from 'react-navigation-stack';
import {createAppContainer} from 'react-navigation';
import Home from './screens/Home';
import searchResult from './screens/searchResult';
import Profile from './screens/Profile';
import SlipScreen from './screens/SlipScreen';
import RegistrationScreen from './screens/RegistrationScreen';
import personalSlip from './screens/personalSlip';

const AppNavigator = createStackNavigator({
  Home: { screen: Home },
  searchResult: { screen: searchResult},
  Profile: {screen: Profile},
  SlipScreen: {screen: SlipScreen},
  RegistrationScreen: {screen: RegistrationScreen},
  personalSlip: {screen: personalSlip},

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
