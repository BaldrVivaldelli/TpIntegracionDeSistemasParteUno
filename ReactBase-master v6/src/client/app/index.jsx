import React from 'react';
import {render} from 'react-dom';
import {List} from './List.jsx';
import {FilterTextBox} from './FilterTextBox.jsx'
import { SearchComponent } from './SearchComponent.jsx'
import { MostPopularSearch } from './MostPopularSearch.jsx'


class App extends React.Component {


  constructor(props){
    super(props);
    //estado es como sifuera una gran objeto de javascript que se llama session donde le cargo todo
    this.state = {
      futureList : [],
      filter : "",
      topTen : []
    };
  }
//esto se llama apenas se hace el objeto en el json. Eso lo hace en el bundle en algun lado
  componentDidMount(){
    fetch("api/getTopTen")
       .then((res) => res.json())
       .then((datos)=>{        
         this.setState({
           topTen : datos,
         })
       }).catch(function(error) {
         console.log('There has been a problem with your fetch operation: ' + error.message)
       });
  }


  applyfilter(filter){
    const newState = {
       futureList : this.state.futureList,
        filter : filter
    }
    this.setState(newState)
    
  }
  loadData(futureList){
    const newState = {
      futureList: futureList,
      filter: this.state.filter
    }
    this.setState(newState)
  }

  render () {
    const serverList = this.state.futureList.map((serRes) => <List serverResp={serRes} />)
    //en las propiedades que se envianen los tags tienen que ser las de los modulos internos
    const topTenList = <MostPopularSearch topTen={this.state.topTen} />
    return <div>
            
            <h3>Filtro</h3>
            <FilterTextBox onUpdate={(filter) => this.applyfilter(filter)} /> 
            <SearchComponent onUpdate={(futureList) => this.loadData(futureList)} 
                                      filter={this.state.filter} />
			{serverList}
            <h3 id="Top">Most popular search</h3>
            {topTenList}
          </div>;
  }
}

render(<App/>, document.getElementById('app'));
