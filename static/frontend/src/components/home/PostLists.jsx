import React, {PropTypes} from 'react';
import PostItem from './PostItem';
import  smoothScroll from 'smoothscroll';

class PostLists extends React.Component {

    render() {
        let itemNodes = this.props.posts.map(function (post) {
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

    componentDidUpdate(prevProps) {
        if (prevProps.posts.length > 0 && this.props.posts.length > 0) {
            smoothScroll(document.querySelector('.container'));
        }
    }
}

export default PostLists;