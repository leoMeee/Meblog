import React from 'react';
import {Row, Col, Table, Button, Card, Icon}  from  'antd';
import {connect} from  'react-redux';
import rest from "../../store/rest";
import DateFormatter from '../../libs/DateFormatter';


class Posts extends React.Component {


    constructor(props) {
        super(props);
        let {dispatch} = this.props;
        dispatch(rest.actions.posts.reset('sync'));
        dispatch(rest.actions.posts.sync({
            fields: 'id,title,created_at'
        }));
    }

    handleTableChange(pagination, filters, sorter) {
        const {dispatch} = this.props;
        let sort = sorter.order == 'ascend' ? sorter.field : '-' + sorter.field;
        dispatch(rest.actions.posts.reset('sync'));
        return dispatch(rest.actions.posts.sync({
            page: pagination.current,
            fields: 'id,title,created_at',
            sort: sort
        }));
    }

    render() {
        const {posts, dispatch} = this.props;
        const columns = [{
            title: '日志标题',
            dataIndex: 'title',
            key: 'title',
            width: '60%'
        }, {
            title: '发布时间',
            dataIndex: 'created_at',
            key: 'created_at',
            width: '25%',
            sorter: true,
            render:(text,record)=>(
                DateFormatter(text)
            )
        }, {
            title: '操作',
            key: 'operation',
            width: '15%',
            render: (text, record) => (
                <span>
                  <a href="#">修改</a>
                  <span className="ant-divider">&nbsp;</span>
                  <a href="#">删除</a>
                  <span className="ant-divider">&nbsp;</span>
                </span>
            ),
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
            <Card title="日志列表" bordered={false}>
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