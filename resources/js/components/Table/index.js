import React from 'react';
import ReactDOM from "react-dom";
import TableContainer from "./TableContainer";
if (document.getElementById('table')) {
  ReactDOM.render(<TableContainer />, document.getElementById('table'));
}
