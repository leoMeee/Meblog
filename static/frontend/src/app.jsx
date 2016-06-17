import 'babel-polyfill'
import React from 'react';
import ReactDOM from  'react-dom';
import {Provider} from 'react-redux';
import {Router, hashHistory, applyRouterMiddleware} from 'react-router';
import routes from './routes';
import configureStore from './store/configureStore'
import useScroll from 'react-router-scroll';

var store = configureStore();

function shouldUpdateScroll(prevRouterProps, { routes }) {
    if (routes.some(route => route.ignoreScrollBehavior)) {
        return false;
    }

    if (routes.some(route => route.scrollToTop)) {
        return [0, 0];
    }

    return true;
}

ReactDOM.render(
    <Provider store={store}>
        <Router routes={routes} history={hashHistory} render={applyRouterMiddleware(useScroll(shouldUpdateScroll))}/>
    </Provider>,
    document.querySelector('#main')
);