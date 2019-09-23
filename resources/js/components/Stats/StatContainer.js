import React from 'react';

class StatContainer extends React.Component {
  state = {
    data: []
  };

  componentDidMount() {
    axios.post('api/getDayStats',{}).then(({data}) => {
      this.setState({data})
    })
  }

  render() {
    const {data} = this.state;

    return (
      <div className="hidden md:flex md:pl-4 ">
        <div className="shadow pl-4 px-3 py-2 rounded w-full">
          <p className="uppercase text-center text-sm font-bold text-heading">статистика за сутки</p>
          <ul className="mt-3 flex flex-wrap">
            {data.map((item,index) => {
              const imgUrl = 'storage/type/' + item.img_url;
              return (
                <li key={item.img_url} className="flex flex-col rounded border border-border m-1 items-center p-2">
                  <img className="h-4 " src={imgUrl}   alt=""/>
                  <span className="font-bold text-content">{item.project_count}</span>
                </li>
              )
            })}
          </ul>
        </div>
      </div>
    )
  }
}

export default StatContainer;
