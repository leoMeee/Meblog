import React from 'react';
import {Row}  from  'antd';

class Post extends React.Component {
    render() {
        return (
            <div >
                {this.props.children}
            </div>
        )
    }
}

export default  Post;