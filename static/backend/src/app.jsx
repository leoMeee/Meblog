import React from 'react';
import ReactDOM from 'react-dom';
import {Provider} from 'react-redux';
import configureStore from './store/configureStore';
import {Router, hashHistory, applyRouterMiddleware} from 'react-router';
import routes from './routes';

var store = configureStore();

ReactDOM.render(
    <Provider store={store}>
        <Router routes={routes} history={hashHistory}/>
    </Provider>,
    document.querySelector('#main-wrapper')
);
