import React from 'react';
import Article from '../components/view/Article';
import ArticleHeader from '../components/view/ArticleHeader';
import Banner from './../components/common/Banner';
import {bindActionCreators} from 'redux';
import {connect} from  'react-redux';
import * as Actions from '../actions'

class View extends React.Component {
    componentWillMount() {
        const {actions} = this.props;
        actions.fetchArticle(this.props.params.id).then(()=>actions.loadProgress(80));
    }
    
    render() {
        const {article} = this.props;
        return (
            <div>
                <Banner img="/img/post-bg.jpg">
                    <ArticleHeader {...article}/>
                </Banner>
                <div className="container">
                    <Article {...article}/>
                </div>
            </div>
        )
    }
}

function mapStateToProps(state) {
    return {
        article: state.article
    }
}

function mapDispatchToProps(dispatch) {
    return {
        actions: bindActionCreators(Actions, dispatch)
    }
}

View = connect(mapStateToProps, mapDispatchToProps)(View);

export default View;