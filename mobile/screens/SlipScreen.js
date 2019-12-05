import React from 'react';
import { Block, theme, NavBar, Input } from "galio-framework";
import { ActivityIndicator, FlatList, TouchableOpacity,StyleSheet, Text, View ,Button,Image} from 'react-native';
import {Card,Divider} from 'react-native-elements';

export default class SlipScreen extends React.Component {
    static navigationOptions=({navigation})=>{
        return {
            title:"Your Slip",
        headerStyle:{backgroundColor:"#fff"},
        headerTitleStle:{textAlign:"center",flex:1}
        };
    };
    constructor(props){
         super(props);
         this.state={
             loading: true,
             dataSource:[]
         };

     }
    
    FlatListItem=()=>{
        return(
               <View style={{
               height:.5,
               width:"100%",
               backgroundColor:"rgba(0,0,0,0.5)",
               }}
               />
               );
    }
    

    componentDidMount(){
        var UN=this.props.navigation.state.params.Username;
        var PW=this.props.navigation.state.params.Pass;

        fetch("https://tripslip.net/api/?user="+UN+"&pass="+PW+"").then(response =>response.json()).then((responseJson)=>{
                    this.setState({
                        loading:false,
                        dataSource:responseJson
                       })
                   })
               .catch(error=>console.log(error))
           }
    



     renderItem=(data)=>
     <Block>
    <TouchableOpacity style={styles.Card}>
       <Card
        title = {data.item.location}
       />
     </TouchableOpacity>
<View>
    {data.item.login === 'false' && <Text> Invalid Credentials </Text>}
        {data.item.login === 'true' && <Text> Successful Login </Text> }
            <Text> {data.item.location} </Text>
    </View>

     </Block>

    render() {
   
      return (
        <View style={styles.container}>

              <Text> Username: {this.props.navigation.state.params.Username} </Text>
          <Text> Password: {this.props.navigation.state.params.Pass} </Text>
                    <FlatList
                        data={this.state.dataSource}
                   ItemSeparatorComponent={this.FlatListItemSeparator}
                        renderItem={item=>this.renderItem(item)}
            //            keyExtractor={item=>item.id.toString()}
                        />

              </View>
      );
    }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
  loader:{
    flex:1,
    justifyContent:"center",
    alignItems: "center",
    backgroundColor:"#fff"
  },
  list:{
    paddingVertical:4,
    margin:5,
    backgroundColor:"#fff"
   }
});
