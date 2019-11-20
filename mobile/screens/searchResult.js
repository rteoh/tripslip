import React from 'react';
import { Block, theme, NavBar, Input } from "galio-framework";
import { ActivityIndicator, FlatList, TouchableOpacity,StyleSheet, Text, View ,Button,Image} from 'react-native';
import {Card,Divider} from 'react-native-elements';

export default class searchResult extends React.Component {

    static navigationOptions=({navigation})=>{
        return {
            title:"Places to Consider",
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
    componentDidMount(){
        var str=this.props.navigation.state.params.JSON_ListView_Clicked_Item;
        str=str.replace(/\s+/g,'-');
        fetch("https://tripslip.net/api/"+str+"").then(response =>response.json()).then((responseJson)=>{
             this.setState({
                 loading:false,
                 dataSource:responseJson
                })
            })
        .catch(error=>console.log(error))
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

    renderItem=(data)=>
    <Block>
    <TouchableOpacity style={styles.Card}>
      <Card
      image= {{uri:data.item.image_url}}
      title={data.item.name}
      />
    </TouchableOpacity>
   
    <Button
             capitalize
             round
             size="small"
             shadowless
           color="#4a90e2"
           title="Add to slip"
    />

    </Block>

    render() {
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

        if(this.state.loading){
            return(
                   <View style={styles.loader}>
                        <ActivityIndicator size="large" color="#0c9"/>
                   </View>
                   )}
    return (

            
      <View style={styles.container}>
            <FlatList
            data={this.state.dataSource}
       ItemSeparatorComponent={this.FlatListItemSeparator}
            renderItem={item=>this.renderItem(item)}
//            keyExtractor={item=>item.id.toString()}
            />
  
            </View>
            
            
            )}
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
