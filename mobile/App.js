import React,{Component} from 'react';
import {Text,View,Image,StyleSheet,TextInput,Button} from 'react-native';



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
                        style={{height:40}}
                        placeholder="Type your location here"
                        onChangeText={(text)=>this.setState({text})}
                        value={this.state.text}
                    />
               <Button
               onPress={()=>{
               alert('Next screen coming soon');
               }}
               title="Create Itinerary"
               />
               </View>

        );
    }
}
