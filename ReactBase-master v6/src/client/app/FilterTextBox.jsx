import React from 'react';

export class FilterTextBox extends React.Component{

    constructor(props){
        super(props)
        this.state = {
            filter : ""
        }
    };

    filterInput(e){
        var filter = e.target.value;
        this.setState({
            filter : filter
        })
       this.props.onUpdate(filter)
       
    };
    render(){
        return  <div id="searchTextboxId">
            <input id ="searchTextbox" type="text" name="fname" 
            value = {this.state.filter}
            onChange = {(e)=> this.filterInput(e)}></input>
        </div>
    }
}