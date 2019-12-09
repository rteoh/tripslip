import React from 'react';
import { Block, theme, NavBar, Input,Button} from "galio-framework";
import { ActivityIndicator, FlatList, TouchableOpacity,StyleSheet, Text, View,Image,Alert} from 'react-native';
import {Card,Divider} from 'react-native-elements';

export default class SlipScreen extends React.Component {
    static navigationOptions=({navigation})=>{
        return {
            title:"Your Slips",
        headerStyle:{backgroundColor:"#fff"},
        headerTitleStle:{textAlign:"center",flex:1}
        };
    };
    constructor(props){
         super(props);
         this.state={
             loading: true,
             dataSource:[],
             text:'',
         };

     }
    
    FlatListItem=()=>{
        return(
               <View style={{
               height:.0,
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
           containerStyle={{padding: 1}}
           title = {data.item.location[0]}
           image={{uri:data.item.image}}
               />


  
     </TouchableOpacity>
     </Block>

    render() {
       
    const {navigate}=this.props.navigation;
      return (
        <View style={styles.list}>
                    <FlatList
                        data={this.state.dataSource}
               ItemSeparatorComponent={this.FlatListItemSeparator}
                        renderItem={item=>this.renderItem(item)}
            //            keyExtractor={item=>item.id.toString()}
                        />
              <View style={styles.gap}>
              <Button
                           capitalize
                           round
                           size="small"
                           shadowless
                           color="#4a90e2"
                           onPress={() =>
                           navigate('personalSlip',{JSON_ListView_Clicked_Item: this.state.text})
                           }
                         >View Slip</Button>
                </View>
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
   },
    gap:{
    flex:1,
    paddingVertical:30,
    justifyContent: 'space-around',
    alignItems: 'center',
    },
});
