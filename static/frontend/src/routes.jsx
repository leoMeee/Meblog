import React from 'react';
import {Route,IndexRoute} from 'react-router';
import App from './containers/App';
import Home from './containers/Home';
import View from './containers/View';

export default(
    <Route path="/" component={App}>
        <IndexRoute component={Home}/>
        <Route path="/view/:id" component={View}/>
    </Route>
)