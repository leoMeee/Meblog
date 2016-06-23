import React from 'react';
import {Menu, Col, Icon}  from  'antd';
import './sidebar.css'


class SideBar extends React.Component {
    render() {
        return (
            <div id="sidebar-wrapper">
                <Menu mode="inline" theme="dark" defaultSelectedKeys={['user']}>
                    <Menu.Item key="user">
                        <Icon type="user"/><span className="nav-text">用户管理</span>
                    </Menu.Item>
                    <Menu.Item key="setting">
                        <Icon type="setting"/><span className="nav-text">网站设置</span>
                    </Menu.Item>
                    <Menu.Item key="laptop">
                        <Icon type="laptop"/><span className="nav-text">日志管理</span>
                    </Menu.Item>
                    <Menu.Item key="notification">
                        <Icon type="notification"/><span className="nav-text">导航管理</span>
                    </Menu.Item>
                    <Menu.Item key="folder">
                        <Icon type="folder"/><span className="nav-text">评论管理</span>
                    </Menu.Item>
                </Menu>
                <div className="aside-action" onClick={this.props.onCollapseChange}>
                    {this.props.collapse ? <Icon type="right"/> : <Icon type="left"/>}
                </div>
            </div>
        )
    }
}

export default SideBar;