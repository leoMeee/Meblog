import React, {PropTypes} from 'react';
import PostItem from './PostItem';

class PostLists extends React.Component {

    render() {
        let itemNodes = this.props.posts.items.map(function (post) {
            return (
                <PostItem {...post} />
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