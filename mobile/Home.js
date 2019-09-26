import React,{Component} from 'react';
import { StyleSheet, Text, View,Button,Image,TextInput } from 'react-native';

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
            <TextInput style={{height:40,width:200}}
                placeholder= "Santa Barbara, New York,..."
//            onChangeText={(text)=>this.setSate({text})}
//            value={this.state.text}
            />
            
            <Button
              title="Get a Slip"
              onPress={() =>
            navigate('Profile')}
            />
      </View>
    );
  }
}

