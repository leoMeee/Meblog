import React from 'react';
import {connect} from  'react-redux';
import rest from "../../store/rest";
import {message} from 'antd';
import EditComponent from "../../components/post/edit";

class Edit extends React.Component {

    constructor(props) {
        super(props);
        const {dispatch} = props;
        if(props.params.id > 0){
            dispatch(rest.actions.post.get({id:props.params.id}));
        }
    }

    saveContent(title,content, status) {
        const {dispatch,post} = this.props;
        dispatch(rest.actions.post.reset('sync'));
        let body = {'Post[title]': title, 'Post[content]': content, 'Post[status]': status};
        let params = post.data.id ? {id: post.data.id} : {};
        let request = post.data.id ? rest.actions.post.put : rest.actions.post.post;
            dispatch(request(params, {body: body}, (err, data)=> {
            if (err == null) {
                let successText = status == 2 ? '已成功发布' : '已成功存入草稿箱';
                message.success(successText);
            }
        }));
    }

    render() {
        const {post, history} = this.props;
        return (
            <EditComponent post={post} history={history} saveContent={this.saveContent.bind(this)}/>
        )
    }

    componentWillUnmount() {
        const {dispatch} = this.props;
        dispatch(rest.actions.post.reset());
    }
}

function mapStateToProps(state) {
    return {
        post: state.post
    }
}


Edit = connect(mapStateToProps)(Edit);

export default  Edit;