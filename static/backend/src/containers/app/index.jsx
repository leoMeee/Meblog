import React from 'react';
import 'antd/dist/antd.css';
import './app.css';
import Header from '../../components/header';
import SideBar from '../../components/sidebar';
import Main from '../../components/main';

class App extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            collapse: true,
        }
    }

    onCollapseChange() {
        this.setState({
            collapse: !this.state.collapse
        })
    }

    render() {
        const collapse = this.state.collapse;
        return (
            <div id="framework-wrapper" className={collapse ? "layout-aside layout-aside-collapse" : "layout-aside"}>
                <Header />
                <SideBar collapse={collapse} onCollapseChange={this.onCollapseChange.bind(this)}/>
                <Main>
                    {this.props.children}
                </Main>
            </div>
        );
    }
}

export default App;
