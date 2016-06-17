import React, {PropTypes} from 'react';
import PostItem from './PostItem';

class PostLists extends React.Component {

    shouldComponentUpdate(props) {
        return this.props.posts !== props.posts;
    }

    render() {
        let itemNodes = this.props.posts.map(function (post, key) {
            return (
                <PostItem {...post} key={key}/>
            )
        });
        return (
            <div className="row">
                <div className="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    {itemNodes}
                </div>
            </div>
        )
    }
}

export default PostLists;