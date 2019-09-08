import React from 'react';

const FilterContext = React.createContext({
  filter: {keywords: [], types: []},
  changeFilter: () => {}
});

export default FilterContext;
