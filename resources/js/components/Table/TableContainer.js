import React from 'react';
import axios from 'axios';
import TableRow from "./TableRow";
import FilterContainer from "../Filter/FilterContainer";

class TableContainer extends React.Component {

  constructor (props) {
    super(props)

    const limit = 25;

    let localFilter = localStorage.getItem('coderman_filter');
    let oldFilter = {
      'show': limit
    };

    if (localFilter) {
      localFilter = JSON.parse(localFilter);
      oldFilter = {
        'keywords': localFilter.keywords,
        'selectedType': localFilter.selectedType,
        'show': limit
      };

    }

    this.state = {
      tableHeaders: [
        {
          'name': 'Ссылка',
          'type': 'url',
          'classes': " flex items-center text-sm py-1"
        },
        {
          'name': 'Дата',
          'type': 'date_published_at',
          'classes': " hidden md:table-cell md:flex md:items-center md:justify-center text-sm"
        }
      ],
      data: [],
      dataInterval: null,
      filter: oldFilter
    };

    this.syncData = this.syncData.bind(this);
    this.changeFilter = this.changeFilter.bind(this);
  }

  componentDidMount () {
    this.syncData();
    this.interval = setInterval(() => this.syncData(), 30000);
  }


  componentWillUnmount () {
    clearInterval(this.interval);
  }

  syncData () {
    const { filter } = this.state;

    axios.post('/api/getData', {
      filter
    }).then(({ data }) => {
      this.setState({ data: data });
    });
  }

  changeFilter (params) {
    let filterNew = params;
    const { filter } = this.state;

    filterNew.show = filter.show;

    this.setState({ filter: filterNew }, () => {
      this.syncData();
      this.saveLocalStorage();
    });
  }

  showDescription (e, t) {
    t.preventDefault();
    const pTaq = document.getElementById(e + '_description');

    if (pTaq.classList.contains('hidden')) {
      pTaq.classList.remove('hidden');
    } else {
      pTaq.classList.add('hidden');
    }

  }

  saveLocalStorage = () => {
    const { filter: { selectedType, keywords } } = this.state;
    const filterObj = { keywords, selectedType };
    localStorage.setItem('coderman_filter', JSON.stringify(filterObj));
  };

  onLoadMore = () => {
    let { filter } = this.state;

    filter.show += 10;

    this.setState(filter, () => {
      this.syncData();
    })

  };

  render () {
    const { tableHeaders, data } = this.state;

    if (!data.length) return (
      <React.Fragment>
        <div className="flex items-center justify-center  md:w-9/12">
          <span className="animated infinite fadeIn delay-2s text-center">Загрузка...</span>
        </div>
        <FilterContainer onChangeFilter={this.changeFilter}/>
      </React.Fragment>
    );

    return (
      <React.Fragment>
        <div className="md:w-9/12 order-1 flex flex-col">
          <table className="table-auto w-full shadow">
            <thead>
            <tr>
              {tableHeaders.map((item, index) => {
                const classes = 'hidden md:table-cell px-6 uppercase border-b border-border text-heading ';
                return (
                  <th key={index + '_th'} className={classes}>{item.name}</th>
                )
              })}
            </tr>
            </thead>
            <tbody>
            {data.map((item, index) => {
              return (
                <TableRow key={item.id + '_tr'}>
                  {tableHeaders.map((itemH, indexH) => {
                    const classNames = itemH.classes + ' flex-wrap';
                    let tmpText = item[itemH.type];
                    tmpText.trim();
                    //let text = shorten(tmpText, 150);
                    let text = tmpText;
                    if (item['type'] && itemH.type === 'url') {
                      return (
                        <td className={classNames} key={indexH + '_td'}>
                          <div className="flex items-center">
                            <img className={"mx-2 w-4 "} src={"/storage/type/" + item['type']['img_url']}
                                 alt=""/>
                            <a target="_blank" href={item['url']}>{item['title']}</a>
                            <a href="_blank" onClick={this.showDescription.bind(null, item.id)}
                               className="ml-2 text-blue text-xs">подробнее...</a>
                          </div>
                          <p id={item.id + '_description'}
                             className="hidden ml-8 pb-2 w-full text-sm">{item.description}</p>
                        </td>
                      )
                    }
                    const datePublish = new Date(text);
                    return (
                      <td className={classNames + ' text-center'} key={indexH + '_td'}>
                        <span className="">{datePublish.toLocaleDateString()}</span>
                      </td>
                    )
                  })}
                </TableRow>
              )
            })}

            </tbody>
          </table>
          <button
            onClick={this.onLoadMore}
            className="text-heading self-center mt-5 py-2 px-4 shadow rounded border border-gray-400 hover:bg-gray-100">
            Load More
          </button>
        </div>
        <FilterContainer onChangeFilter={this.changeFilter}/>
      </React.Fragment>
    )
  }
}

export default TableContainer;
