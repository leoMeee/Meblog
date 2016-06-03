import React from 'react';
import ReactDOM from  'react-dom';
import App from './components/App';

var data = {
    app: {
        name: 'MeBlog',
        menus: [
            {
                name: '首页',
                url: '/'
            },
            {
                name: '归档',
                url: '/'
            }
        ]
    },
    banner:{
      img:"/img/about-bg.jpg"  
    },
    user: {
        name: 'leo',
        avatar: '/img/elyse.png',
        say: 'Fear cuts deeper than swords.'
    },
    posts: [
        {
            title: 'linux从入门到精通',
            created_at: '2015年6月8日 14:20'
        },
        {
            title: 'ES6 简单特性概览',
            created_at: '2015年6月8日 14:20'
        },
        {
            title: 'chrome的debug工具Profiles使用方法',
            created_at: '2015年6月8日 14:20'
        }
    ]
};

ReactDOM.render(
    <App {... data} />,
    document.querySelector('#main')
);