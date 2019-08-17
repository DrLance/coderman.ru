import React from 'react';
import ReactDOM from "react-dom";

class TableContainer extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      tableHeaders: ['URL', 'Описание', 'Дата добавления']
    }
  }
  render() {
    const {tableHeaders} = this.state;
    return (
      <table>
        <thead>
        <tr>
          {tableHeaders.map((item, index) => {
            return (
              <th>{item}</th>
            )
          })}
        </tr>
        </thead>
      </table>
    )
  }
}

export default  TableContainer;
