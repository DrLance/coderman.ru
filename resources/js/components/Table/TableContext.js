import React from 'react';
import TableContainer from "./TableContainer";
import FilterContainer from "../Filter/FilterContainer";
import FilterContext from "../../context";

class TableContext extends React.Component {
  render() {
    return (
      <FilterContext.Provider>
        <TableContainer />
        <FilterContainer />
      </FilterContext.Provider>
    )
  }
}

export default TableContext;
