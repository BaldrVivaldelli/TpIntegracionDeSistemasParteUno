import React from 'react';

export class List extends React.Component {
    compnentDidMount(){
    }
  render () {
    const serverResp = this.props.serverResp
    const myList = serverResp.files.map(
          (value)=>
          //la key es el codigo unico que se usa para que react pueda agarrar mas facil la referencia
            <li  key={value.hashName} >            
              <a href={serverResp.server + "/getFileById/"+value.hashName}>{value.nombre}</a>
            </li>
    )  
    return <div><h4>Resultados en  {serverResp.server}</h4><ul> {myList}</ul></div>;
  }
}