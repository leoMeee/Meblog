import React from 'react';
import {Menu, Col, Icon}  from  'antd';
import './sidebar.css'
import {Link} from 'react-router'


class SideBar extends React.Component {
    render() {
        return (
            <div id="sidebar-wrapper">
                <Menu mode="inline" theme="dark" defaultSelectedKeys={['home']}>
                    <Menu.Item key="home">
                        <Icon type="home"/>
                        <Link className="nav-text" to="/">仪表盘</Link>
                    </Menu.Item>
                    <Menu.Item key="post">
                        <Icon type="book"/>
                        <Link className="nav-text" to="/posts">日志管理</Link>
                    </Menu.Item>
                    <Menu.Item key="category">
                        <Icon type="bars"/>
                        <Link className="nav-text" to="/">分类管理</Link>
                    </Menu.Item>
                    <Menu.Item key="user">
                        <Icon type="user"/>
                        <Link className="nav-text" to="/">用户管理</Link>
                    </Menu.Item>
                    <Menu.Item key="setting">
                        <Icon type="setting"/>
                        <Link className="nav-text" to="/">网站设置</Link>
                    </Menu.Item>
                </Menu>
                <div className="aside-action" onClick={this.props.onCollapseChange} >
                    {this.props.collapse ? <Icon type="right"/> : <Icon type="left"/>}
                </div>
            </div>
        )
    }
}

export default SideBar;