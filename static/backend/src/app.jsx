import React from 'react';
import ReactDOM from 'react-dom';
import 'antd/dist/antd.css';
import {Row, Col, Table, Button, Card}  from  'antd';
import './app.css';
import Header from './components/header';
import SideBar from './components/sidebar';
import Main from './components/main';

class App extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            collapse: true,
        }
    }

    onCollapseChange() {
        this.setState({
            collapse: !this.state.collapse
        })
    }

    render() {
        const collapse = this.state.collapse;
        return (
            <div id="framework-wrapper" className={collapse ? "layout-aside layout-aside-collapse" : "layout-aside"}>
                <Header />
                <SideBar collapse={collapse} onCollapseChange={this.onCollapseChange.bind(this)}/>
                <Main>
                    <Row gutter={16}>
                        <Col span="24">
                            <Card title="Card title" bordered={false}>
                                <MyTable />
                            </Card>
                        </Col>
                    </Row>
                </Main>
            </div>
        );
    }
}

const columns = [{
    title: '姓名',
    dataIndex: 'name',
}, {
    title: '年龄',
    dataIndex: 'age',
}, {
    title: '住址',
    dataIndex: 'address',
}];

const data = [];
for (let i = 0; i < 46; i++) {
    data.push({
        key: i,
        name: `李大嘴${i}`,
        age: 32,
        address: `西湖区湖底公园${i}号`,
    });
}

class MyTable extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            selectedRowKeys: [],  // 这里配置默认勾选列
            loading: false,
        }
    }


    start() {
        this.setState({loading: true});
        // 模拟 ajax 请求，完成后清空
        setTimeout(() => {
            this.setState({
                selectedRowKeys: [],
                loading: false,
            });
        }, 1000);
    }

    onSelectChange(selectedRowKeys) {
        console.log('selectedRowKeys changed: ', selectedRowKeys);
        this.setState({selectedRowKeys});
    }

    render() {
        const {loading, selectedRowKeys} = this.state;
        const rowSelection = {
            selectedRowKeys,
            onChange: this.onSelectChange.bind(this),
        };
        const hasSelected = selectedRowKeys.length > 0;
        return (
            <div>
                <div style={{ marginBottom: 16 }}>
                    <Button type="primary" onClick={this.start.bind(this)}
                            disabled={!hasSelected} loading={loading}
                    >操作</Button>
                    <span style={{ marginLeft: 8 }}>{hasSelected ? `选择了 ${selectedRowKeys.length} 个对象` : ''}</span>
                </div>
                <Table rowSelection={rowSelection} columns={columns} dataSource={data}/>
            </div>
        );
    }
}

ReactDOM.render(
    <App/>,
    document.querySelector('#main-wrapper')
);
