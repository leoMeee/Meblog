import React from 'react';
import {Row, Col, Table, Button, Card, Icon, Input, Affix, BackTop}  from  'antd';
import {connect} from  'react-redux';
import rest from "../../store/rest";
import 'simplemde/dist/simplemde.min.css';
import 'github-markdown-css';
import './edit.css';
import {markdown} from 'markdown'
import  SimpleMDE from 'simplemde/dist/simplemde.min';
import hljs from '../../libs/react-highlight/lib'
import '../../libs/react-highlight/highlight.css'

class Edit extends React.Component {

    constructor(props) {
        super(props);
        this.simplemde = null;
        this.state = {
            previewActive: false
        }
    }

    handlePreview() {
        this.simplemde.togglePreview();
        this.setState({
            previewActive: !this.state.previewActive
        })
    }

    render() {
        const {post,history} = this.props;
        return (
            <div>
                <Row gutter={16}>
                    <Col span="24">
                        <Card title="写日志" extra={<Button onClick={()=>(history.push('/posts'))} type="primary">日志列表</Button>}>
                            <textarea name="" id="editor" value={post.data.content}/>
                        </Card>
                    </Col>
                </Row>
                <Row style={{marginTop:15}}>
                    <Col>
                        <Card >
                            <Button type="primary" size="large" icon="save">发布</Button>
                            <Button size="large">存为草稿</Button>
                        </Card>
                    </Col>
                </Row>
                <div className="ant-back-top" style={{ bottom:  42}} onClick={this.handlePreview.bind(this)}>
                    <Button type="primary" size="large">{this.state.previewActive ? '编辑' : '预览'}</Button>
                </div>
            </div>
        )
    }

    componentDidMount() {
        this.simplemde = new SimpleMDE({
            toolbar: [
                "bold",
                "italic",
                "heading",
                "|",
                "quote",
                "unordered-list",
                "ordered-list",
                "|",
                "link",
                "image",
                "|",
                "table",
                "|",
                "preview"

            ],
            parsingConfig: {
                allowAtxHeaderWithoutSpace: true
            },
            spellChecker: false,
            renderingConfig: {
                codeSyntaxHighlighting:true
            },
            previewRender: function (text) {
                var wrapper= document.createElement('div');
                wrapper.innerHTML= '<div class="markdown-body">' + markdown.toHTML(text, 'Maruku') + '</div>';
                var nodes = wrapper.querySelectorAll('pre code');
                if (nodes.length > 0) {
                    for (var i = 0; i < nodes.length; i = i + 1) {
                        hljs.highlightBlock(nodes[i]);
                    }
                }
                return wrapper.innerHTML;
            }
        });
    }
}

function mapStateToProps(state) {
    return {
        post: state.post
    }
}


Edit = connect(mapStateToProps)(Edit);

export default  Edit;