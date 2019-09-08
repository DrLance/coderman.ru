import React from 'react';
import axios from 'axios';
import FilterContext from "../../context";

class FilterContainer extends React.Component {

  static contextType = FilterContext;

  constructor( props ) {
    super( props );

    this.state = {
      types: [],
      keywords: ['test', 'test2']
    };

    this.onChangeType = this.onChangeType.bind( this );
    this.onAddKeyword = this.onAddKeyword.bind( this );
    this.onRemoveKeyword = this.onRemoveKeyword.bind( this );

    this.refKeyword = React.createRef();

  }

  componentDidMount() {
    axios.post( 'api/getTypes' ).then( ( { data } ) => {
      this.setState( { types: data } )
    } )
  }

  onChangeType( e, value ) {
    console.log( e.target.value );
  }

  onAddKeyword( e ) {
    let { keywords } = this.state;
    keywords.push( e.target.value );

    if ( e.target.value ) {
      this.setState( { keywords } );
    }
    e.target.value = null;
    this.context = keywords;
  }

  onRemoveKeyword( e ) {
    let { keywords } = this.state;

    const currentValue = e.target.attributes.getNamedItem( 'data-keyword' ).value

    const newKeywords = keywords.filter( ( item ) => item !== currentValue && item !== '' );

    this.setState( { keywords: newKeywords } );

    this.context = newKeywords;
  }

  render() {
    const { types, keywords } = this.state;

    return (
      <aside id="filter-side" className="md:w-3/12 flex">
        <div className="w-full pl-4">
          <div className="shadow pl-4 px-3 py-2 rounded">
            <p className="uppercase mb-5 text-center">фильтр</p>
            <label htmlFor="filter_type" className="flex flex-col font-bold">Фриланс биржа
              <select className="mb-5 mt-1 py-1 border-b-2 mb-3 text-lg" name="filter_type"
                      onChange={ this.onChangeType }>
                <option value="0">Все</option>
                { types.map( ( item, index ) => {
                  return (
                    <option key={ index + '_opt' } value={ item.id }>{ item.name }</option>
                  )
                } ) }
              </select>
              <label className="mb-3">Ключевые слова
                <div className="flex flex-wrap mb-2">
                  { keywords.map( ( item, index ) => {
                    return (
                      <div ref={ this.refKeyword } key={ item + '_keyword' + index } className="pl-2 shadow mr-2 mt-1">
                        { item }
                        <span className="pl-2 pr-2 hover:bg-blue-200" data-keyword={ item }
                              onClick={ this.onRemoveKeyword }>x</span>
                      </div>
                    )
                  } ) }
                </div>
                <input name="keywords" className="focus:outline-none border-b-2" onBlur={ this.onAddKeyword }/>
              </label>
            </label>
            <button className="bg-green-600 rounded py-2 shadow text-white" type="submit">Отфильтровать</button>
          </div>
        </div>
      </aside>
    )
  }
}

export default FilterContainer;


