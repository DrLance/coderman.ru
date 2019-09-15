import React from 'react';

class TableRow extends React.PureComponent{

  render() {
    return (
      <tr className="hover:shadow border border-border fadeIn animated " >
        {this.props.children}
      </tr>
    )
  }

}

export default TableRow;
