import React,{Component} from 'react';
import {Button,Input,Block} from 'galio-framework'
import { StyleSheet, Text, View,Image,TextInput,Alert } from 'react-native';
import{Avatar,Overlay} from 'react-native-elements';

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
});

export default class RegistrationScreen extends React.Component {
    static navigationOptions={
        title:'Create an Account',
    };
    constructor(props){
        super(props);
        this.state={typedUser:'',typedEmail:'',typedPass:'',typedConfirm:'',};
    }
    
  render() {
      const {navigate}=this.props.navigation;
    return (
      <View style={styles.container}>
       <Text> Enter the Following to Register: </Text>

            <Input
              style={{height:40,width:225}}
              placeholder="Username"
              right
              rounded
              icon="user"
              family="antdesign"
              iconSize={14}
              iconColor="#4a90e2"
            onChangeText={(typedUser)=>this.setState({typedUser})}
            value={this.state.typedUser}
        
            />
            
            <Input
                       style={{height:40,width:225}}
                       placeholder="Email"
                       right
                       rounded
                       icon="mail"
                       family="antdesign"
                       iconSize={14}
                       iconColor="#4a90e2"
                     onChangeText={(typedEmail)=>this.setState({typedEmail})}
                     value={this.state.typedEmail}
                 
                     />
            <Input
                       style={{height:40,width:225}}
                       placeholder="Password"
                       right
                       rounded
                       icon="key"
                       family="antdesign"
                       iconSize={14}
                       iconColor="#4a90e2"
                        secureTextEntry={true}
                     onChangeText={(typedPass)=>this.setState({typedPass})}
                     value={this.state.typedPass}
                 
                     />
            <Input
                              style={{height:40,width:225}}
                              placeholder="Confirm Password"
                              right
                              rounded
                              icon="key"
                              family="antdesign"
                              iconSize={14}
                              iconColor="#4a90e2"
                            secureTextEntry={true}
            
                        onChangeText={(typedConfirm)=>this.setState({typedConfirm})}
                            value={this.state.typedConfirm }
                        
                            />

            
            <Button
              capitalize
              round
              size="small"
              shadowless
              color="#4a90e2"
              onPress={() => Alert.alert(
                'Your Account is Now Ready',
                'Go Back and Log in',
                [
                  {text: 'OK', onPress: this.onDeleteBTN},
                ],
                { cancelable: false }
              )}
            >Register</Button>
           
      </View>
    );
  }
}

