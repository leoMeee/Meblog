import React from 'react';
import {Route, IndexRoute} from 'react-router';
import App from './containers/App';
import Dashboard from './containers/Dashboard';
import Post from './containers/Post';
import PostList from './containers/Post/list';
import PostEdit from './containers/Post/edit';

export default(
    <Route path="/" component={App}>
        <IndexRoute component={Dashboard}/>
        <Route path="posts" component={Post}>
            <IndexRoute component={PostList}/>
            <Route path="edit(/:id)" component={PostEdit}/>
        </Route>
    </Route>
)