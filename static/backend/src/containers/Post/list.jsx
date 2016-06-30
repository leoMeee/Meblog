import React from 'react';
import {Row, Col, Table, Button, Card, Icon, Tag, Alert, Select}  from  'antd';
import {connect} from  'react-redux';
import rest from "../../store/rest";
import DateFormatter from '../../libs/DateFormatter';
import * as PostConstants from '../../constants/PostConstants';
import {Link} from 'react-router';
import {message} from 'antd';
import Search from '../../components/util/search'


class Posts extends React.Component {


    constructor(props) {
        super(props);
        this.page = 1;
        this.sort = null;
        this.state = {
            selectedRowKeys: []
        };
        this.loadPosts();
    }

    handleTableChange(pagination, filters, sorter) {
        if (sorter.order) {
            this.sort = sorter.order == 'ascend' ? sorter.field : '-' + sorter.field;
        }
        this.page = pagination.current;
        this.loadPosts();
    }

    handleUpdateStatus(id, status) {
        const {dispatch} = this.props;
        const loadPosts = this.loadPosts.bind(this);
        switch (status) {
            case PostConstants.STATUS_DRAFT:
                status = PostConstants.STATUS_PUBLISHED;
                break;
            case PostConstants.STATUS_PUBLISHED:
                status = PostConstants.STATUS_DRAFT;
                break;
        }
        dispatch(rest.actions.postStatus.sync({id, status}))
            .then(()=>message.success('操作成功'))
            .then(function () {
                loadPosts();
            });
    }

    loadPosts() {
        const {dispatch} = this.props;
        dispatch(rest.actions.posts.reset('sync'));
        dispatch(rest.actions.posts.sync({
            page: this.page,
            sort: this.sort,
        }));
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
        const body = {"data":JSON.stringify(params)};
        dispatch(rest.actions.updatePostBatch.sync({}, {body}))
            .then((response)=>message.success('成功更新了 '+response.success_ids.length+' 条数据'))
            .then(function () {
                loadPosts();
                setState({
                    selectedRowKeys: []
                });
            });
    }

    render() {
        const {posts, dispatch, history} = this.props;
        const columns = [{
            title: '日志标题',
            dataIndex: 'title',
            key: 'title',
            width: '50%'
        }, {
            title: '发布时间',
            dataIndex: 'created_at',
            key: 'created_at',
            width: '20%',
            sorter: true,
            render: (text, record)=>(
                DateFormatter(text)
            )
        }, {
            title: '状态',
            dataIndex: 'status',
            key: 'status',
            width: '15%',
            render: (text, record)=>(
                <Tag
                    color={record.status == PostConstants.STATUS_PUBLISHED ? 'green' : 'yellow'}>
                    {record.status == PostConstants.STATUS_PUBLISHED ? '已发布' : '草稿箱'}
                </Tag>
            )
        }, {
            title: '操作',
            key: 'operation',
            width: '15%',
            render: (text, record) => (
                <span>
                    <Link to={'/posts/edit/'+record.id}>修改</Link>
                  <span className="ant-divider">&nbsp;</span>
                  <a onClick={this.handleUpdateStatus.bind(this,record.id,record.status)}>
                      {record.status == PostConstants.STATUS_PUBLISHED ? '草稿箱' : '发布'}
                  </a>
                  <span className="ant-divider">&nbsp;</span>
                </span>
            )
        }];
        const {selectedRowKeys} = this.state;
        const hasSelected = selectedRowKeys.length > 0;
        const rowSelection = {
            selectedRowKeys,
            onChange: this.onSelectChange.bind(this)
        };
        const pagination = {
            total: posts.data._meta.totalCount,
            pageSize: posts.data._meta.perPage,
        };

        return (
            <Row>
                <Col span="24">
                    <Card title="日志列表" bordered={false}
                          extra={<Button onClick={()=>(history.push('/posts/edit'))} type="primary" icon="edit">写日志</Button>}>
                        <div>
                            <Row style={{ marginBottom: 16 }}>
                                <Col span={8}>
                                    <Button type="primary" disabled={!hasSelected}
                                            onClick={this.onBatchDraft.bind(this)}>存入草稿箱</Button>
                                    <span
                                        style={{ marginLeft: 8}}>{hasSelected ? `选择了 ${selectedRowKeys.length} 条数据` : ''}</span>
                                </Col>
                                <Col span={3} offset={9}>
                                    <Select defaultValue="lucy">
                                        <Option value="jack">草稿箱</Option>
                                        <Option value="lucy">已发布</Option>
                                    </Select>
                                </Col>
                                <Col span={4}>
                                    <Search  />
                                </Col>
                            </Row>
                            <Table
                                pagination={pagination}
                                columns={columns}
                                dataSource={posts.data.items}
                                loading={posts.loading}
                                rowKey={record => record.id}
                                rowSelection={rowSelection}
                                onChange={this.handleTableChange.bind(this)}
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