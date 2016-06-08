import 'babel-polyfill'
import React from 'react';
import thunk from 'redux-thunk'
import ReactDOM from  'react-dom';
import {Provider} from 'react-redux';
import {createStore, applyMiddleware} from 'redux';
import rootReducer from  './reducers';
import Home from './containers/Home';

var store = createStore(rootReducer, {}, applyMiddleware(thunk));

ReactDOM.render(
    <Provider store={store}>
        <Home />
    </Provider>,
    document.querySelector('#main')
);