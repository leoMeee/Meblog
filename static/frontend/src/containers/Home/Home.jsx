import React from 'react';
import {bindActionCreators} from 'redux';
import {connect} from  'react-redux';
import Banner from './../../components/common/Banner';
import BannerContent from '../../components/home/BannerContent';
import PostLists from './../../components/home/PostLists';
import Pager from './../../components/home/Pager';
import * as Actions from '../../actions';
import rest from "../../store/rest";


class Home extends React.Component {


    constructor(props) {
        super(props);
        let {dispatch} = this.props;
        dispatch(rest.actions.banner.sync()).then(()=>dispatch(Actions.loadProgress(40)));
        let page = this.props.params.page || 1;
        dispatch(rest.actions.posts.sync({
            page: page,
            fields: 'id,title,created_at'
        })).then(()=>dispatch(Actions.loadProgress(40)));
    }

    _handlePage(page) {
        const {dispatch} = this.props;
        dispatch(rest.actions.posts.reset('sync'));
        return dispatch(rest.actions.posts.sync({
            page: page,
            fields: 'id,title,created_at'
        }))
    }

    render() {
        const {banner, posts, dispatch} = this.props;
        let _meta = posts.data._meta;
        let pager = _meta.pageCount > 1 ? <Pager {..._meta} dispatch={dispatch} handleClick={this._handlePage}/> : '';

        return (
            <div>
                <Banner {...banner.data}>
                    <BannerContent {...banner.data.user} />
                </Banner>
                <div className="container">
                    <PostLists posts={posts.data.items}/>
                </div>
                {pager}
            </div>
        )
    }

    componentWillUnmount() {
        const {dispatch} = this.props;
        dispatch(rest.actions.posts.reset('sync'));
        dispatch(rest.actions.banner.reset('sync'));
    }


}


function mapStateToProps(state) {
    return {
        banner: state.banner,
        posts: state.posts
    }
}


Home = connect(mapStateToProps)(Home);

export default Home;