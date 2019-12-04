import React,{Component} from 'react';
import {Button,Input,Block} from 'galio-framework'
import { StyleSheet, Text, View,Image,TextInput,TouchableOpacity } from 'react-native';


const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
                                 gap:{
                                 flex:0.15,
                                 justifyContent: 'space-around',
                                 },
});

export default class Profile extends React.Component {
    static navigationOptions={
        title:'Welcome to Tripslip!',
    };
    constructor(props){
        super(props);
        this.state={typedUser:'',typedPass:' ',/*username:'',password:''*/};
    }
    
  render() {
      const {navigate}=this.props.navigation;
    return (
      <View style={styles.container}>
            
            <Image source={{uri:'https://tripslip.net/img/black-logo.png'}}
            style={{width:275,height:100}}/>
        
       <Text> Login or Register to see your Slip! </Text>

            <Input
              style={{height:40,width:225}}
              placeholder="username"
              right
              rounded
              icon="user"
              family="antdesign"
              iconSize={16}
              iconColor="#4a90e2"
            onChangeText={(typedUser)=>this.setState({typedUser})}
            value={this.state.typedUser}
//            onChangeText={(username)=>this.setState({username})}

        
            />
            <Input
                         style={{height:40,width:225}}
                         placeholder="password"
                         right
                         rounded
                         icon="key"
                         family="antdesign"
                         iconSize={16}
                         iconColor="#4a90e2"
                        secureTextEntry="true"
                        onChangeText={(typedPass)=>this.setState({typedPass})}
//                        value={this.state.typedPass}
//                       onChangeText={(password)=>this.setState({password})}
                      
                   
                       />
            <Button
              capitalize
              round
              size="small"
              shadowless
            color="#4a90e2"
              onPress={() =>
            navigate('SlipScreen',{Username:this.state.typedUser, Pass: this.state.typedPass})
            }
            >Login</Button>
            
            <View style = {styles.gap}>
            <Button
                         capitalize
                         round
                         size="small"
                         shadowless
                       color="#4a90e2"
                         onPress={() =>
                       navigate('searchResult',{JSON_ListView_Clicked_Item: this.state.text,})
                       }
                       >Register</Button>
            
            </View>

      </View>
    );
  }
}

