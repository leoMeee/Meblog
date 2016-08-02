import React from 'react';
import {Menu, Row, Col}  from  'antd';
import './header.css'


class Header extends React.Component {
    render() {
        return (
            <div id="header-wrapper">
                <Row >
                    <Col span={24}>
                        <div className="header-logo" type="left">
                            <img height="33" src="https://os.alipayobjects.com/rmsportal/mlcYmsRilwraoAe.svg"/>
                        </div>
                    </Col>
                </Row>
            </div>
        )
    }
}

export default Header;