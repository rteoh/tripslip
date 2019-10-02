import React from 'react';
import { ActivityIndicator, FlatList, TouchableOpacity,StyleSheet, Text, View ,Button} from 'react-native';

export default class searchResult extends React.Component {
    static navigationOptions=({navigation})=>{
        return {
            title:"Source Listing",
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
    fetch("https://tripslip.net/api/orange").then(response =>response.json()).then((responseJson)=>{
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
               backgroundColor:"rgba(0,0,0,0.5",
               }}
               />
               );
    }
    renderItem=(data)=>
    <TouchableOpacity style={styles.list}>
    <Text style={styles.lightText}>{data.item.name}</Text>
    </TouchableOpacity>
    render() {
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
                

//            <Text> Yelp images and names go here! </Text>
//            <Button
//              title="Back to home"
//              onPress={() =>
//                this.props.navigation.navigate('Home')
//              }
//            />
//            </View>
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
