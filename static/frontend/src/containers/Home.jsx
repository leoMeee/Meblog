import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from  'react-redux';
import Banner from './../components/common/Banner';
import BannerContent from '../components/home/BannerContent';
import PostLists from './../components/home/PostLists';
import * as Actions from '../actions'


class Home extends React.Component {
    componentWillMount() {
        const {actions} = this.props;
        actions.fetchBanner().then(()=>actions.loadProgress(40));
        actions.fetchPosts().then(()=>actions.loadProgress(40));
    }

    render() {
        const {banner, posts} = this.props;
        return (
            <div>
                <Banner {...banner}>
                    <BannerContent {...banner.user} />
                </Banner>
                <div className="container">
                    <PostLists posts={posts}/>
                </div>
            </div>
        )
    }

}

function mapStateToProps(state) {
    return {
        banner: state.banner,
        posts: state.posts,
    }
}

function mapDispatchToProps(dispatch) {
    return {
        actions: bindActionCreators(Actions, dispatch)
    }
}

Home = connect(mapStateToProps, mapDispatchToProps)(Home);

export default Home;