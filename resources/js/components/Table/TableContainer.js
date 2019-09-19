import React from 'react';
import axios from 'axios';
import TableRow from "./TableRow";
import FilterContainer from "../Filter/FilterContainer";
import { shorten } from "./../../utils";

class TableContainer extends React.Component {

  constructor (props) {
    super(props);
    this.state = {
      tableHeaders: [
        {
          'name': 'Ссылка',
          'type': 'url',
          'classes': "flex items-center flex-grow w-12/12"
        },
        {
          'name': 'Дата',
          'type': 'date_published_at',
          'classes': " w-3/12 text-center"
        }
      ],
      data: [],
      dataInterval: null,
      filter: {}
    };

    this.syncData = this.syncData.bind(this);
    this.changeFilter = this.changeFilter.bind(this);
  }

  componentDidMount () {
    this.syncData();
    this.interval = setInterval(() => this.syncData(), 5000);
  }


  componentWillUnmount () {
    clearInterval(this.interval);
  }

  syncData () {
    const { filter } = this.state;
    axios.post('/api/getData', {
      filter
    }).then(({ data }) => {
      this.setState({ data: data })
    });
  }

  changeFilter (params) {
    this.setState({ filter: params }, () => this.syncData());
  }

  showDescription(e,t) {
    t.preventDefault();
    const pTaq = document.getElementById(e + '_description');

    if(pTaq.classList.contains('hidden')) {
      pTaq.classList.remove('hidden');
    } else {
      pTaq.classList.add('hidden');
    }

  }

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
        <div className="md:w-9/12">
          <table className="table-auto w-full">
            <thead>
            <tr className="">
              {tableHeaders.map((item, index) => {
                const classes = 'justify-center px-6 uppercase border-b border-border text-heading ' + item.classes;
                return (
                  <th key={index + '_th'}
                      className={classes}>{item.name}</th>
                )
              })}
            </tr>
            </thead>
            <tbody>
            {data.map((item, index) => {
              return (
                <TableRow key={item.id + '_tr'}>
                  {tableHeaders.map((itemH, indexH) => {
                    const classNames = " text-xs flex-wrap" + itemH.classes;
                    let tmpText = item[itemH.type];
                    tmpText.trim();
                    //let text = shorten(tmpText, 150);
                    let text = tmpText;
                    if (item['type'] && itemH.type === 'url') {
                      return (
                        <td className={classNames} key={indexH + '_td'}>
                          <div className="flex items-center">
                            <img className={"p-2 h-8 w-8"} src={"/storage/type/" + item['type']['img_url']}
                                 alt=""/>
                            <a target="_blank" href={item['url']}>{item['title']}</a>
                            <a href="_blank" onClick={this.showDescription.bind(null, item.id)} className="ml-2 text-blue text-xs">подробнее...</a>
                          </div>
                          <p id={item.id + '_description'} className="hidden ml-8 pb-2 w-full text-sm">{item.description}</p>
                        </td>
                      )
                    }
                    return (
                      <td className={classNames} key={indexH + '_td'}>{text}</td>
                    )
                  })}
                </TableRow>
              )
            })}

            </tbody>
          </table>
        </div>
        <FilterContainer onChangeFilter={this.changeFilter}/>
      </React.Fragment>
    )
  }
}

export default TableContainer;
