import React from 'react';
import ReactDOM from 'react-dom';
import FilterContainer from "./FilterContainer";
import FilterContext from "../Table/index";

if ( document.getElementById( 'filter-side' ) ) {
  ReactDOM.render(
    <FilterContext.Provider>
      <FilterContainer/>
    </FilterContext.Provider>,
    document.getElementById( 'filter-side' ) );
}

