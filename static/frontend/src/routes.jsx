import React from 'react';
import {Route,IndexRoute} from 'react-router';
import App from './containers/App/App';
import Home from './containers/Home/Home';
import View from './containers/View/View';

export default(
    <Route path="/(:page)" component={App}>
        <IndexRoute  component={Home}/>
        <Route path="/view/:id" component={View}/>
    </Route>
)