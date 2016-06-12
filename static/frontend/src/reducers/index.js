import {combineReducers} from 'redux';
import posts from './posts';
import nav from './nav';
import banner from './banner';
import load from './load';
import article from './article';

const rootReducer = combineReducers({
    posts: posts,
    nav: nav,
    banner: banner,
    load: load,
    article: article
});

export default rootReducer