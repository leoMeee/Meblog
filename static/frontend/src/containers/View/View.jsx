import React from 'react';
import Article from '../../components/view/Article';
import ArticleHeader from '../../components/view/ArticleHeader';
import Banner from './../../components/common/Banner';
import {bindActionCreators} from 'redux';
import {connect} from  'react-redux';
import * as Actions from '../../actions'
import rest from "../../store/rest";
import 'nprogress/nprogress.css';

class View extends React.Component {

    constructor(props) {
        super(props);
        const {dispatch} = props;
        dispatch(rest.actions.post.get({id: this.props.params.id}, ()=>dispatch(Actions.loadProgress(80))));
    }

    shouldComponentUpdate(nextProps, nextState) {
       return nextProps.post.sync;
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
    
    componentWillUnmount() {
        const {dispatch} = this.props;
        dispatch(rest.actions.post.reset('sync'));
    }

}

function mapStateToProps(state) {
    return {
        post: state.post
    }
}


View = connect(mapStateToProps)(View);

export default View;