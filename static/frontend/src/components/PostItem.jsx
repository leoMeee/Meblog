import React from 'react';

class PostItem extends React.Component {

    render(){
        return (
            <div className="post-preview">
                <a href="/">
                    <h2 className="post-title">
                        {this.props.title}
                    </h2>
                </a>
                <p className="post-meta">发布于 {this.props.created_at}</p>
            </div>
        )
    }
}

export default PostItem;