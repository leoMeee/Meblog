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
        let page = this.props.params.page || 1;
        dispatch(rest.actions.banner.sync()).then(dispatch(Actions.loadProgress(40)));
        dispatch(rest.actions.posts.sync({
            page: page,
            fields: 'id,title,created_at'
        })).then(dispatch(Actions.loadProgress(40)));
    }

    shouldComponentUpdate(props) {
        if (props.params.page && props.params.page != this.props.params.page) {
            let {dispatch} = props;
            dispatch(rest.actions.posts.reset('sync'));
            dispatch(rest.actions.posts.sync({
                page: props.params.page,
                fields: 'id,title,created_at'
            }))
        }
        return this.props.posts !== props.posts;
    }

    render() {
        const {banner, posts} = this.props;
        let _meta = posts.data._meta;
        let pager = _meta.pageCount > 1 ? <Pager {..._meta}/> : '';

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

}

function mapStateToProps(state) {
    return {
        banner: state.banner,
        posts: state.posts
    }
}


Home = connect(mapStateToProps)(Home);

export default Home;