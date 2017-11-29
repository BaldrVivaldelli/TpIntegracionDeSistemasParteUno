import React from 'react';
import {FilterTextBox} from './FilterTextBox.jsx'

export class SearchComponent extends React.Component{

    constructor(props){
        super(props)
    }
    searchValueFromNetWork(){
        const data = {
            "data" : this.props.filter
        };
        const values = fetch("api/buscar",{
            "headers": {
                'Content-Type': 'application/json'
            },
            "method": "POST",
            "body": JSON.stringify(data)
        })
        .then((res) => res.json())
        .then((datos) => {
            //las funnciones que le paso del index a los "hijos" estan enlasadas
            this.props.onUpdate(datos)
        });
        //(futureList,filterdList);
    }

    render(){
        return  <div id="btnDiv">
            <button class="btn" onClick={() => this.searchValueFromNetWork()}>
                Buscar
            </button>
        </div>
    }
}