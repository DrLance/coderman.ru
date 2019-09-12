import React from 'react';
import { BarChart, Bar, Line, YAxis, XAxis, Legend, CartesianGrid, ResponsiveContainer, Tooltip } from 'recharts';

export default class SampleLineChart extends React.Component {
  constructor( props ) {
    super( props );
    const today = new Date();
    let subMonth = new Date();

    subMonth.setMonth(subMonth.getMonth() - 1);

    this.state = {
      dateStart: subMonth.toISOString().substr( 0, 10 ),
      dateEnd: today.toISOString().substr( 0, 10 ),
      data: []
    };

    this.fetchData = this.fetchData.bind( this );
  }

  componentDidMount() {
    this.fetchData();
  }

  fetchData() {
    const { dateStart, dateEnd } = this.state;
    let filter = { 'dateStart': dateStart, 'dateEnd': dateEnd };

    axios.post( '/api/getStats', { 'filter': filter } ).then( ( { data } ) => {
      this.setState( { data } );
    } )
  }

  changeDate = ( type, e ) => {
    if ( type === 'start' ) {
      let dateStart = new Date(e.target.value);

      dateStart =  dateStart.getFullYear() +'-'+ (dateStart.getMonth() + 1) + '-' + dateStart.getDate();

      this.setState({dateStart},() => {
        this.fetchData();
      });
    } else if(type === 'end') {
      let dateEnd = new Date(e.target.value);

      dateEnd =  dateEnd.getFullYear() +'-'+ (dateEnd.getMonth() + 1) + '-' + dateEnd.getDate();
      this.setState({dateEnd},() => {
        this.fetchData();
      });
    }
  };

  render() {
    let today = new Date();
    today = today.toISOString().substr( 0, 10 );
    let container = document.getElementById('charts');
    const widthContainer = container.getClientRects()[0].width;

    return (

      <div className="flex flex-col">
        <label className="text-center text-bold mb-10">Период c
          <input className="ml-2 w-25 border-2" type="date" defaultValue={ this.state.dateStart }
                 onChange={ ( e ) => this.changeDate( 'start', e ) } max={today}/>

          <span className="ml-1 mr-1">по</span>
          <input className="w-25 border-2" type="date" defaultValue={ this.state.dateEnd }
                 onChange={ ( e ) => this.changeDate( 'end', e ) }
          />
        </label>
        <BarChart data={ this.state.data } width={widthContainer} height={350}>
          <CartesianGrid strokeDasharray="3 3"/>
          <XAxis dataKey="name"/>
          <YAxis label={{ value: 'Кол-во заказов', angle: -90, position: 'insideLeft' }}/>
          <Tooltip />
          <Bar type="monotone" dataKey="uv" fill="#8884d8" barSize={ 60 }/>
        </BarChart>

      </div>
    );
  }
}


