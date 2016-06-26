import React from 'react';
import {Row, Col, Card}  from  'antd';

class Dashboard extends React.Component {
    render() {
        return (
            <div>
                <Row gutter={12}>
                    <Col span={24}>
                        <Card >
                            <h1>Welcome!</h1>
                        </Card>
                    </Col>
                </Row>
                <Row gutter={12} style={{marginTop:'12px'}}>
                    <Col span={8}>
                        <Card >
                            <h1>Welcome!</h1>
                        </Card>
                    </Col>
                    <Col span={16}>
                        <Card >
                            <h1>Welcome!</h1>
                        </Card>
                    </Col>
                </Row>
            </div>

        )
    }
}

export default  Dashboard;