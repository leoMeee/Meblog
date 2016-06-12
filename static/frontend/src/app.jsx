import 'babel-polyfill'
import React from 'react';
import thunk from 'redux-thunk'
import ReactDOM from  'react-dom';
import {Provider} from 'react-redux';
import {createStore, applyMiddleware} from 'redux';
import rootReducer from  './reducers';
import {Router, hashHistory} from 'react-router';
import routes from './routes';

var store = createStore(rootReducer, {}, applyMiddleware(thunk));

ReactDOM.render(
    <Provider store={store}>
        <Router routes={routes} history={hashHistory}/>
    </Provider>,
    document.querySelector('#main')
);