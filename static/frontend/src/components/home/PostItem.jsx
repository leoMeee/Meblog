import React from 'react';
import {Link} from 'react-router';

class PostItem extends React.Component {

    render(){
        const url = '/view/'+this.props.id;
        return (
            <div className="post-preview">
                <Link to={url}>
                    <h2 className="post-title">
                        {this.props.title}
                    </h2>
                </Link>
                <p className="post-meta">发布于 {this.props.created_at}</p>
            </div>
        )
    }
}

export default PostItem;