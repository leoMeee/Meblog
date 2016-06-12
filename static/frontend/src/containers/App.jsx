import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from  'react-redux';
import * as Actions from '../actions'
import Navigation from './../components/common/Navigation';
import Footer from  './../components/common/Footer';
import Loading from '../components/common/Loading';

class App extends React.Component {
    componentWillMount() {
        const {actions} = this.props;
        actions.fetchNav().then(()=>actions.loadProgress(20));
    }

    render() {
        const {nav, load, children} = this.props;
        let mainClass = 'main ' + load.styles.mainStyle;
        return (
            <div>
                <div>
                    <Loading style={load.styles.loadStyle}/>
                    <div className={mainClass}>
                        <Navigation {...nav} />
                        {children}
                        <hr/>
                        <Footer {...nav}/>
                    </div>
                </div>
            </div>
        )
    }
}

function mapStateToProps(state) {
    return {
        nav: state.nav,
        load: state.load
    }
}

function mapDispatchToProps(dispatch) {
    return {
        actions: bindActionCreators(Actions, dispatch)
    }
}

App = connect(mapStateToProps, mapDispatchToProps)(App);

export default App;