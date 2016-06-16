import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from  'react-redux';
import Banner from './../../components/common/Banner';
import BannerContent from '../../components/home/BannerContent';
import PostLists from './../../components/home/PostLists';
import * as Actions from '../../actions';
import rest from "../../store/rest";


class Home extends React.Component {

    constructor(props) {
        super(props);
        const {actions, dispatch} = props;
        dispatch(actions.banner.sync(()=>dispatch(actions.loadProgress(40))));
        dispatch(actions.posts.sync(()=>dispatch(actions.loadProgress(40))));
    }

    render() {
        const {banner, posts} = this.props;
        return (
            <div>
                <Banner {...banner.data}>
                    <BannerContent {...banner.data.user} />
                </Banner>
                <div className="container">
                    <PostLists posts={posts.data}/>
                </div>
            </div>
        )
    }

}

function mapStateToProps(state) {
    return {
        banner: state.banner,
        posts: state.posts
    }
}

function mapDispatchToProps(dispatch) {
    return {
        dispatch: dispatch,
        actions: Object.assign({}, Actions, rest.actions)
    }
}

Home = connect(mapStateToProps, mapDispatchToProps)(Home);

export default Home;