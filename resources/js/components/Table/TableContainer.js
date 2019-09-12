import React from 'react';
import axios from 'axios';
import TableRow from "./TableRow";
import FilterContainer from "../Filter/FilterContainer";
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
          'classes': "w-6/12 pl-4 break-all"
        },
        {
          'name': 'Дата',
          'type': 'date_published_at',
          'classes': " text-xs text-center"
        }
      ],
      data: [],
      dataInterval: null,
      filter: {}
    };

    this.syncData = this.syncData.bind( this );
    this.changeFilter = this.changeFilter.bind( this );
  }

  componentDidMount() {
    this.syncData();
    this.interval = setInterval( () => this.syncData(), 5000 );
  }


  componentWillUnmount() {
    clearInterval( this.interval );
  }

  syncData() {
    const { filter } = this.state;
    axios.post( '/api/getData', {
      filter
    } ).then( ( { data } ) => {
      this.setState( { data: data } )
    } );
  }

  changeFilter( params ) {
    this.setState( { filter: params }, () => this.syncData() );

  }

  render() {
    const { tableHeaders, data } = this.state;

    if ( !data.length ) return (
      <React.Fragment>
      <div className="flex items-center justify-center  md:w-9/12">
        <span className="animated infinite fadeIn delay-2s text-center">Загрузка...</span>
      </div>
      <FilterContainer onChangeFilter={ this.changeFilter }/>
      </React.Fragment>
    );

    return (
      <React.Fragment>
        <div className="md:w-9/12">
          <table className="table-fixed" >
            <thead >
            <tr className="border-t-2 ">
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
                    if ( item['type'] && itemH.type === 'url' ) {
                      return (
                        <td className={ classNames } key={ indexH + '_td' }>
                          <img className={ "p-2 h-8 w-8" } src={ "/storage/type/" + item['type']['img_url'] }
                               alt="" />
                          <a target="_blank" href={ item['url'] }>{ item['title'] }</a>
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
        </div>
        <FilterContainer onChangeFilter={ this.changeFilter }/>
      </React.Fragment>
    )
  }
}

export default TableContainer;
