import 'babel-polyfill'
import React from 'react';
import ReactDOM from  'react-dom';
import {Provider} from 'react-redux';
import {Router, hashHistory} from 'react-router';
import routes from './routes';
import configureStore from './store/configureStore'

var store = configureStore();

ReactDOM.render(
    <Provider store={store}>
        <Router routes={routes} history={hashHistory}/>
    </Provider>,
    document.querySelector('#main')
);