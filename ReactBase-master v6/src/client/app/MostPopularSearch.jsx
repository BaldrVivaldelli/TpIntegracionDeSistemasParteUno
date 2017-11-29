import React from 'react';

export class MostPopularSearch extends React.Component {
    compnentDidMount(){
    }
  render () {
    const serverResp = this.props.topTen
    const myList = serverResp.map(
          (value)=>
          //la key es el codigo unico que se usa para que react pueda agarrar mas facil la referencia
            <li  key={value._id} >            
              {value._id} {value.count}
            </li>
    )  
    return <div><ul> {myList}</ul></div>;
  }
}