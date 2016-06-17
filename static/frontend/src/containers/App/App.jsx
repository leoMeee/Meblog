import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from  'react-redux';
import * as Actions from '../../actions';
import rest from "../../store/rest";
import Navigation from './../../components/common/Navigation';
import Footer from  './../../components/common/Footer';
import Loading from '../../components/common/load/Loading';
import 'expose?jQuery!jquery/dist/jquery.min';
import 'bootstrap/dist/js/bootstrap.min';
import 'bootstrap/dist/css/bootstrap.min.css';
import './app.css';

class App extends React.Component {

    constructor(props) {
        super(props);
        const {dispatch} = props;
        dispatch(rest.actions.app.sync()).then(()=>dispatch(Actions.loadProgress(20)));
    }

    render() {
        const {app, load, children} = this.props;
        let mainClass = 'main ' + load.styles.mainStyle;
        return (
            <div>
                <div>
                    <Loading style={load.styles.loadStyle}/>
                    <div className={mainClass}>
                        <Navigation {...app.data} />
                        {children}
                        <hr/>
                        <Footer {...app.data}/>
                    </div>
                </div>
            </div>
        )
    }
}

function mapStateToProps(state) {
    return {
        app: state.app,
        load: state.load
    }
}

App = connect(mapStateToProps)(App);

export default App;