import React,{Component} from 'react';
import {Button,Input,Block} from 'galio-framework'
import { StyleSheet, Text, View,Image,TextInput } from 'react-native';

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
});

export default class Home extends React.Component {
    static navigationOptions={
        title:'Welcome to Tripslip!',
    };
    constructor(props){
        super(props);
        this.state={text:''};
    }
    
  render() {
      const {navigate}=this.props.navigation;
    return (
      <View style={styles.container}>
            
            <Image source={{uri:'https://tripslip.net/img/black-logo.png'}}
            style={{width:275,height:100}}/>
        
       <Text> Enter a location: </Text>

            <Input
              style={{height:40,width:225}}
              placeholder="Santa Barbara, New York,..."
              right
              rounded
              icon="location"
              family="entypo"
              iconSize={14}
              iconColor="blue"
            onChangeText={(text)=>this.setState({text})}
            value={this.state.text}
        
            />
            <Button
              capitalize
              round
              size="small"
              shadowless
            color="#4a90e2"
              onPress={() =>
            navigate('searchResult',{JSON_ListView_Clicked_Item: this.state.text,})
            }
            >Get a Slip</Button>
      </View>
    );
  }
}

