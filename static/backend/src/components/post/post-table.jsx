import React from 'react';
import {Table, Tag} from 'antd';
import {Link} from 'react-router';
import DateFormatter from '../../libs/DateFormatter';
import * as PostConstants from '../../constants/PostConstants';


class PostTable extends React.Component {

    handleUpdateStatus(id, status) {
        switch (status) {
            case PostConstants.STATUS_DRAFT:
                status = PostConstants.STATUS_PUBLISHED;
                break;
            case PostConstants.STATUS_PUBLISHED:
                status = PostConstants.STATUS_DRAFT;
                break;
        }
        this.props.handleUpdateStatus(id, status);
    }

    render() {
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
                  <span className="ant-divider"> </span>
                  <a onClick={this.handleUpdateStatus.bind(this,record.id,record.status)}>
                      {record.status == PostConstants.STATUS_PUBLISHED ? '草稿箱' : '发布'}
                  </a>
                </span>
            )
        }];
        return (
            <Table
                pagination={this.props.pagination}
                columns={columns}
                dataSource={this.props.dataSource}
                loading={this.props.loading}
                rowKey={record => record.id}
                rowSelection={this.props.rowSelection}
                onChange={this.props.onChange}
            />
        )
    }
}

export default PostTable;