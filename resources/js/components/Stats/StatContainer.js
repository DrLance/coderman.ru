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
      <div className="w-full pl-4 mt-5">
        <div className="shadow pl-4 px-3 py-2 rounded">
          <p className="uppercase text-center text-sm font-bold">статистика за сутки</p>
          <ul className="mt-3">
            {data.map((item,index) => {
              const imgUrl = 'storage/type/' + item.img_url;
              return (
                <li key={item.img_url} className="flex items-center">
                  <img className="h-4 " src={imgUrl}   alt=""/>
                  <span className="ml-3 font-bold">: {item.project_count}</span>
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
