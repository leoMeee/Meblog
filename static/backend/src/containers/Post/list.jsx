import React from 'react';
import {Row, Col, Table, Button, Card, Icon, Tag}  from  'antd';
import {connect} from  'react-redux';
import rest from "../../store/rest";
import DateFormatter from '../../libs/DateFormatter';
import * as PostConstants from '../../constants/PostConstants';
import {Link} from 'react-router';
import {message} from 'antd';


class Posts extends React.Component {


    constructor(props) {
        super(props);
        this.page = 1;
        this.sort = null;
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
        const rowSelection = {
            onChange(selectedRowKeys, selectedRows) {
                console.log(`selectedRowKeys: ${selectedRowKeys}`, 'selectedRows: ', selectedRows);
            },
            onSelect(record, selected, selectedRows) {
                console.log(record, selected, selectedRows);
            },
            onSelectAll(selected, selectedRows, changeRows) {
                console.log(selected, selectedRows, changeRows);
            },
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