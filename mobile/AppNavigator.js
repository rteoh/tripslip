import { createStackNavigator } from 'react-navigation-stack';
import {createAppContainer} from 'react-navigation';
import Home from './Home';
import Profile from './Profile';

const AppNavigator = createStackNavigator({
  Home: { screen: Home },
  Profile: { screen: Profile},

});
const App=createAppContainer(AppNavigator);

export default App;
