import {combineReducers} from 'redux';
import posts from './posts';
import nav from './nav';
import banner from './banner';
import load from './load';

const rootReducer = combineReducers({
    posts: posts,
    nav: nav,
    banner: banner,
    load: load
});

export default rootReducer