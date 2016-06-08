import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from  'react-redux';
import Navigation from './../components/Navigation';
import Loading from './../components/Loading';
import Banner from './../components/Banner';
import PostLists from './../components/PostLists';
import Footer from  './../components/Footer';
import * as Actions from '../actions'

class Home extends React.Component {
    componentWillMount() {
        const {actions} = this.props;
        actions.fetchNav().then(()=>actions.loadProgress(20));
        actions.fetchBanner().then(()=>actions.loadProgress(40));
        actions.fetchPosts().then(()=>actions.loadProgress(40));
    }

    render() {
        const {nav, banner, posts, load} = this.props;
        if (load.progress == 100) {
            return (
                <div className="main">
                    <Navigation {...nav} />
                    <Banner {...banner} />
                    <div className="container">
                        <PostLists posts={posts}/>
                    </div>
                    <hr/>
                    <Footer {...nav}/>
                </div>
            )
        } else {
            return (
                <Loading />
            )
        }

    }

}

function mapStateToProps(state) {
    return {
        nav: state.nav,
        banner: state.banner,
        posts: state.posts,
        load: state.load
    }
}

function mapDispatchToProps(dispatch) {
    return {
        actions: bindActionCreators(Actions, dispatch)
    }
}

Home = connect(mapStateToProps, mapDispatchToProps)(Home);

export default Home;