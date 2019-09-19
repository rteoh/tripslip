import React,{Component} from 'react';
import {Text,View,Image,StyleSheet,TextInput,Button} from 'react-native';
//import {createAppContainer} from 'react-navigation';
//import {createStackNavigator} from 'react-navigation-stack';



const styles = StyleSheet.create({
    bigTitle: {
    color:'black',
    fontWeight: 'bold',
    fontSize: 30,
    },
    description: {
    color:'black',
    fontSize:20,
    },
    buttonContainer: {
    marginRight: 40,
    marginLeft: 40,
    marginTop:10,
    paddingTop:10,
    paddingBottom:10,
//    backgroundColor:'#a9a9a9',
    borderRadius:10,
    borderWidth: 1,
//    borderColor: '#fff'
    }
    });



export default class HelloWorld extends Component{
    constructor(props){
        super(props);
        this.state={text:''};
    }
    render(){
        return(
               <View style={{flex:1, justifyContent:"center",
               alignItems:"center"}}>
               <Image source={{uri:'https://www.freelogodesign.org/file/app/client/thumb/dca7d371-521b-4d8e-a72e-6c1ef5c2e668_200x200.png?1568834991242'}}
               style={{width: 275, height:100}}/>
               <Text style={styles.bigTitle}> Welcome to TripSlip!</Text>
               <Text style={styles.description}> Enter a location: </Text>
                    <TextInput
               style={{height:40, width:100}}
                        placeholder="Type Here"
                        onChangeText={(text)=>this.setState({text})}
                        value={this.state.text}
                    />
               <View style={styles.buttonContainer}>
               <Button
               onPress={()=>{
               alert('Next screen coming soon');
               }}
               title="Create Itinerary"
               />
               </View>
               </View>

        );
    }
}
