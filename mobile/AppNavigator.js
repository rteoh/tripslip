import { createStackNavigator } from 'react-navigation-stack';
import {createAppContainer} from 'react-navigation';
import Home from './Home';
import searchResult from './searchResult';

const AppNavigator = createStackNavigator({
  Home: { screen: Home },
  searchResult: { screen: searchResult},

});
const App=createAppContainer(AppNavigator);

export default App;
