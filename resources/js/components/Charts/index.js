import React from 'react'
import ReactDOM from 'react-dom';
import LineChart from './LineChart';

if ( document.getElementById( 'charts' ) ) {

  ReactDOM.render(
    <LineChart/>,
    document.getElementById( 'charts' ) );
}
