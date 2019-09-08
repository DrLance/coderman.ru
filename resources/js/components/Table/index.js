import React from 'react';
import ReactDOM from "react-dom";
import TableContext from "./TableContext";

if ( document.getElementById( 'table' ) ) {

  ReactDOM.render(
    <TableContext/>,
    document.getElementById( 'table' ) );
}
