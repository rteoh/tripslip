import React from 'react';
import { Block, Card, theme, NavBar } from "galio-framework";
import { ActivityIndicator, FlatList, TouchableOpacity,StyleSheet, Text, View ,Button,Image} from 'react-native';

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
    fetch("https://tripslip.net/api/"+this.props.navigation.state.params.JSON_ListView_Clicked_Item+"").then(response =>response.json()).then((responseJson)=>{
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
    <TouchableOpacity style={styles.Card}>
    <Text style={styles.container}>{data.item.name}</Text>
      <Image source={{uri:data.item.image_url}} style={{width:275,height:200}}/>
    <Text style={styles.lightText}>Rating: {data.item.rating}</Text>
    <Card
      flex
      shadow
      style={styles.card}
      title={data.item.name}
      caption={data.item.rating}
//      location="Los Angeles, CA"
//      avatar="http://i.pravatar.cc/100?id=skater"
//      imageStyle={styles.cardImageRadius}
      imageBlockStyle={{ padding: theme.SIZES.BASE / 2 }}
          image={{url:data.item.image_url}}
    />
  
    </TouchableOpacity>
    render() {
        <NavBar
        title="Screen Title"
        right
        back
        
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
              <Text>
                You are on SecondPage and the value passed from the first screen is
              </Text>
              {/*Using the navigation prop we can get the value passed from the first Screen*/}
              <Text style={styles.TextStyle}>
                {this.props.navigation.state.params.JSON_ListView_Clicked_Item}
              </Text>
              <Text style={{ marginTop: 16 }}>With Check</Text>
              {/*If you want to check the value is passed or not,
               you can use conditional operator.*/}
              <Text style={styles.TextStyle}>
                {this.props.navigation.state.params.JSON_ListView_Clicked_Item
                  ? this.props.navigation.state.params.JSON_ListView_Clicked_Item
                  : 'No input'}
              </Text>

            
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
