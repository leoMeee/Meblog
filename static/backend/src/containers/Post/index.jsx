import React from 'react';
import {Row, Col}  from  'antd';

class Post extends React.Component {
    render() {
        return (
            <Row >
                <Col span="24">
                    {this.props.children}
                </Col>
            </Row>
        )
    }
}

export default  Post;