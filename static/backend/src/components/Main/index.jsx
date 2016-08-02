import React from 'react';
import {Row, Col}  from  'antd';
import './main.css'


class Main extends React.Component {
    render() {
        return (
            <div id="content-wrapper">
                <div className="layout-content">
                    {this.props.children}
                </div>
            </div>
        )
    }
}

export default Main;