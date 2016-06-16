import React from 'react';
import Article from '../../components/view/Article';
import ArticleHeader from '../../components/view/ArticleHeader';
import Banner from './../../components/common/Banner';
import {bindActionCreators} from 'redux';
import {connect} from  'react-redux';
import * as Actions from '../../actions'
import rest from "../../store/rest";

class View extends React.Component {

    constructor(props) {
        super(props);
        const {actions, dispatch} = props;
        dispatch(actions.post.get({id:this.props.params.id},()=>dispatch(actions.loadProgress(80))));
    }

    render() {
        const {post} = this.props;
        return (
            <div>
                <Banner img="/img/post-bg.jpg">
                    <ArticleHeader {...post.data}/>
                </Banner>
                <div className="container">
                    <Article {...post.data}/>
                </div>
            </div>
        )
    }
}

function mapStateToProps(state) {
    return {
        post: state.post
    }
}

function mapDispatchToProps(dispatch) {
    return {
        dispatch: dispatch,
        actions: Object.assign({}, Actions, rest.actions)
    }
}

View = connect(mapStateToProps, mapDispatchToProps)(View);

export default View;