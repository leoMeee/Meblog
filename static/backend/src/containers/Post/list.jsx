import React from 'react';
import {Row, Col, Table, Button, Card, Icon, Alert, Select, Form, Input}  from  'antd';
import {connect} from  'react-redux';
import rest from "../../store/rest";
import * as PostConstants from '../../constants/PostConstants';
import {message} from 'antd';
import PostTable from '../../components/post/post-table';


class Posts extends React.Component {

    constructor(props) {
        super(props);
        this.page = 1;
        this.sort = null;
        this.state = {
            selectedRowKeys: [],
            operation_loading: false,
            filters: {
                status: PostConstants.STATUS_PUBLISHED,
                title: "",
            },
            shouldFilter: false
        };
        this.timer = true;
        this.loadPosts();
    }

    handleTableChange(pagination, filters, sorter) {
        if (sorter.order) {
            this.sort = sorter.order == 'ascend' ? sorter.field : '-' + sorter.field;
        }
        this.page = pagination.current;
        this.loadPosts();
    }

    componentDidUpdate(prevProps, prevState) {
        if (this.state.shouldFilter === true) {
            this.loadPosts();
            this.setState({shouldFilter: false})
        }
    }

    handleUpdateStatus(id, status) {
        const {dispatch} = this.props;
        const loadPosts = this.loadPosts.bind(this);
        dispatch(rest.actions.postStatus.sync({id, status}))
            .then(()=>message.success('操作成功'))
            .then(function () {
                loadPosts();
            });
    }

    loadPosts() {
        const {dispatch} = this.props;
        const page_sort = {
            page: this.page,
            sort: this.sort,
        };
        dispatch(rest.actions.posts.reset('sync'));
        dispatch(rest.actions.posts.sync(Object.assign({}, this.state.filters, page_sort)));
    }

    onSelectChange(selectedRowKeys) {
        this.setState({selectedRowKeys});
    }

    onBatchDraft() {
        const {dispatch} = this.props;
        const loadPosts = this.loadPosts.bind(this);
        const setState = this.setState.bind(this);
        const selectedRowKeys = this.state.selectedRowKeys
        const params = {};
        for (let i = 0; i < selectedRowKeys.length; i++) {
            params[selectedRowKeys[i]] = {"status": PostConstants.STATUS_DRAFT}
        }
        const body = {"data": JSON.stringify(params)};
        setState({
            operation_loading: true
        });
        setTimeout(() => {
            dispatch(rest.actions.updatePostBatch.sync({}, {body}))
                .then((response)=>message.success('成功更新了 ' + response.success_ids.length + ' 条数据'))
                .then(function () {
                    loadPosts();
                    setState({
                        selectedRowKeys: [],
                        operation_loading: false
                    });
                });
        }, 500)

    }

    onFilterStatus(status) {
        let state = this.state;
        state.filters.status = status;
        state.shouldFilter = true;
        this.setState(state);
    }

    onFilterTitle(e) {
        let state = this.state;
        const setState = this.setState.bind(this);
        state.filters.title = e.target.value;
        this.setState(state);
        clearTimeout(this.timer);
        this.timer = setTimeout(function () {
            state.shouldFilter = true;
            setState(state);
        }, 600);
    }

    render() {
        const {posts, history} = this.props;

        const {selectedRowKeys, operation_loading} = this.state;
        const hasSelected = selectedRowKeys.length > 0;
        const rowSelection = {
            selectedRowKeys,
            onChange: this.onSelectChange.bind(this)
        };
        const pagination = {
            total: posts.data._meta.totalCount,
            pageSize: posts.data._meta.perPage,
        };
        const FormItem = Form.Item;
        const Option = Select.Option
        return (
            <Row>
                <Col span="24">
                    <Card title="日志列表" bordered={false}
                          extra={<Button onClick={()=>(history.push('/posts/edit'))} type="primary" icon="edit">写日志</Button>}>
                        <div>
                            <Row style={{ marginBottom: 16 }} gutter={14}>
                                <Col span={8}>
                                    <Button type="primary" disabled={!hasSelected}
                                            onClick={this.onBatchDraft.bind(this)}
                                            loading={operation_loading}>草稿箱</Button>
                                    <span
                                        style={{ marginLeft: 8}}>{hasSelected ? `选择了 ${selectedRowKeys.length} 条数据` : ''}</span>
                                </Col>
                                <Col span={7} offset={9} style={{textAlign:'right'}}>
                                    <Form inline>
                                        <FormItem>
                                            <Select onChange={this.onFilterStatus.bind(this)}
                                                    defaultValue={this.state.filters.status}>
                                                <Option value={PostConstants.STATUS_DRAFT}>草稿箱</Option>
                                                <Option value={PostConstants.STATUS_PUBLISHED}>已发布</Option>
                                            </Select>
                                        </FormItem>
                                        <FormItem>
                                            <Input placeholder="搜索" value={this.state.filters.title}
                                                   onChange={this.onFilterTitle.bind(this)}/>
                                        </FormItem>
                                    </Form>
                                </Col>
                            </Row>
                            <PostTable
                                rowSelection={rowSelection}
                                pagination={pagination}
                                dataSource={posts.data.items}
                                loading={posts.loading}
                                onChange={this.handleTableChange.bind(this)}
                                handleUpdateStatus = {this.handleUpdateStatus.bind(this)}
                            />
                        </div>
                    </Card>
                </Col>
            </Row>

        );
    }
}
function mapStateToProps(state) {
    return {
        posts: state.posts
    }
}


Posts = connect(mapStateToProps)(Posts);

export default Posts;