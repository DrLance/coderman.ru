import React from 'react';
import axios from 'axios';
import TableRow from "./TableRow";
import { shorten } from "./../../utils";

class TableContainer extends React.Component {
  constructor( props ) {
    super( props );
    this.state = {
      tableHeaders: [
        {
          'name': 'Ссылка',
          'type': 'url',
          'classes': "flex flex-row items-center"
        },
        {
          'name': 'Описание',
          'type': 'description',
          'classes': "w-6/12 pl-4"
        },
        {
          'name': 'Дата',
          'type': 'date_published_at',
          'classes': " text-xs text-center"
        }
      ],
      data: [],
      dataInterval: null
    };

    this.syncData = this.syncData.bind(this);
  }

  componentDidMount() {
    this.syncData();
    this.interval = setInterval( () => this.syncData(), 5000 );
  }

  syncData() {
    axios.post( '/api/getData' ).then(({data}) => {
      this.setState( { data: data } )
    });
  }

  componentWillUnmount() {
    clearInterval(this.interval);
  }



  render() {
    const { tableHeaders, data } = this.state;

    return (
      <table>
        <thead>
        <tr className="border-t-2">
          { tableHeaders.map( ( item, index ) => {
            return (
              <th key={ index + '_th' }
                  className="px-6 font-bold uppercase text-black border-r border-l border-b-2 w-4/12">{ item.name }</th>
            )
          } ) }
        </tr>
        </thead>
        <tbody>
        { data.map( ( item, index ) => {
          return (
            <TableRow key={ item.id + '_tr' }>
              { tableHeaders.map( ( itemH, indexH ) => {
                const classNames = "text-sm border-l border-r " + itemH.classes;
                let tmpText = item[itemH.type];
                tmpText.trim();
                let text = shorten( tmpText, 150 );

                if ( itemH.type === 'url' ) {
                  return (
                    <td className={ classNames } key={ indexH + '_td' }>
                      <img className={"p-2 h-8 w-8"} src={"/storage/type/" + item['type']['img_url']} alt={''} />
                      <a href={ item['url'] }>{ item['title'] }</a>
                    </td>
                  )
                }
                return (
                  <td className={ classNames } key={ indexH + '_td' }>{ text }</td>
                )
              } ) }
            </TableRow>
          )
        } ) }

        </tbody>
      </table>
    )
  }
}

export default TableContainer;
