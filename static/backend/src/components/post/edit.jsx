import React from 'react';
import {Row, Col, Table, Button, Card, Icon, Input, Tooltip, Tag}  from  'antd';
import 'simplemde/dist/simplemde.min.css';
import 'github-markdown-css';
import './../../components/post/edit.css';
import {markdown} from 'markdown'
import  SimpleMDE from 'simplemde/dist/simplemde.min';
import hljs from '../../libs/react-highlight/lib'
import '../../libs/react-highlight/highlight.css';
import DateFormatter from '../../libs/DateFormatter';

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

    saveContent(status) {
        let content = this.simplemde.value();
        this.props.saveContent(content, status)
    }

    render() {
        const {post, history} = this.props;
        const status = {
            1: '未保存',
            2: '已发布',
            3: '已存草稿箱'
        };
        const statusColor = {
            1: 'red',
            2: 'green',
            3: 'yellow'
        };
        return (
            <div>
                <Row gutter={16}>
                    <Col span="24">
                        <Card title="写日志"
                              extra={<Button onClick={()=>(history.push('/posts'))} type="primary">日志列表</Button>}>
                            <textarea name="" id="editor" value={post.data.content}/>
                            <Tag color={statusColor[post.data.status]}>{status[post.data.status]}</Tag>
                            <Tag className="save-time">{DateFormatter(post.data.updated_at, 'MM-DD hh:mm:ss')}</Tag>
                        </Card>
                    </Col>
                </Row>
                <Row style={{marginTop:15}}>
                    <Col span="24">
                        <Card >
                            <Button type="primary" size="large" icon="save"
                                    onClick={this.saveContent.bind(this,2)}>发布</Button>
                            <Button size="large" onClick={this.saveContent.bind(this,3)}>存为草稿</Button>
                        </Card>
                    </Col>
                </Row>
                <div className="ant-back-top" style={{ bottom:  35}} onClick={this.handlePreview.bind(this)}>
                    <Tooltip title="Cmd + Alt + Enter">
                        <Button type="primary" size="large">{this.state.previewActive ? '编辑' : '预览'}</Button>
                    </Tooltip>
                </div>
            </div>
        )
    }

    componentDidUpdate(prevProps) {
        const {post} = this.props;
        if (post.sync == true && prevProps.post.sync == false && post.data.content != prevProps.post.data.content) {
            this.simplemde.value(this.props.post.data.content)
        }
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
            forceSync: true,
            parsingConfig: {
                allowAtxHeaderWithoutSpace: true
            },
            spellChecker: false,
            renderingConfig: {
                codeSyntaxHighlighting: true
            },
            shortcuts: {
                "togglePreview": "Cmd-Alt-Enter"
            },
            previewRender: function (text) {
                var wrapper = document.createElement('div');
                wrapper.innerHTML = '<div class="markdown-body">' + markdown.toHTML(text, 'Maruku') + '</div>';
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


export default  Edit;